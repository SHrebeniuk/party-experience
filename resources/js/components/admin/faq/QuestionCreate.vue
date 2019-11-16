<template>
	<div class="card card-header">
		<div class="form-group">
			<label :for="instance + 'title'">Title</label>
			<input type="text" class="form-control" :class="{'error-shadow': $v.form.title.$error}" :id="instance + 'title'" placeholder="Question title" v-model="form.title">
		</div>
		<div class="form-group">
			<label :for="instance + 'body'">Body</label>
			<textarea rows="5" type="text" class="form-control" :class="{'error-shadow': $v.form.body.$error}" :id="instance + 'body'" placeholder="Question body" v-model="form.body"></textarea>
		</div>
		<div class="form-group" v-if="categories.length > 0">
			<label :for="instance + 'category'">Category</label>
			<select :id="instance + 'category'" class="form-control" v-model="form.category_id">
				<option :value="item.id" v-for="item in categories">{{ item.title }}</option>
			</select>
		</div>
		<div class="d-flex justify-content-center">
			<button class="btn btn-success" :disabled="disabled" @click="submit">
				<template v-if="question">
					Update
				</template>
				<template v-else>
					Create
				</template>
			</button>
		</div>
	</div>
</template>
<script>
	import { required } from 'vuelidate/lib/validators'

	export default {
		name: 'QuestionCreate',

		props: ['user', 'question'],

		data() {
			return {
				categories: [],
				disabled: false,
				instance: 'question-',
				form: {
					title: null,
					body: null,
					author_id: null,
					category_id: null
				}
			}
		},

		validations: {
			form: {
				title: { required },
				body: { required }
			}
		},

		computed: {

		},

		mounted() {
			axios.get('/api/v1/categories')
			.then(response => {
				this.categories = response.data
			})
			.catch(error => {
							
			})
		},

		methods: {
			submit() {
				this.$v.form.$touch();
				let isValid = !this.$v.form.$invalid;

				if(isValid) {
					this.disabled = true

					this.form.author_id = this.user.id
					if(!this.question) {

						axios.post('/api/v1/questions', this.form)
						.then(response => {
							this.$swal('Your Question was created!', '', 'success')
							.then((willDelete) => {
								window.location.href = '/questions'
							})
							.catch((willDelete) => {
								window.location.href = '/questions'
							});
							this.disabled = false
						})
						.catch(error => {
							this.$swal(error.response.data.message, '', 'error');
							this.disabled = false		
						})

					} else {
						
						axios.put(`/api/v1/questions/${this.question.id}`, this.form)
						.then(response => {
							this.$swal('Your Question was updated!', '', 'success')
							.then((willDelete) => {
								window.location.href = '/questions'
							})
							.catch((willDelete) => {
								window.location.href = '/questions'
							});
							this.disabled = false
						})
						.catch(error => {
							this.$swal(error.response.data.message, '', 'error');
							this.disabled = false		
						})
					}

				}
			},

			handleUploaded(resp) {
				this.form.image_url = resp.image_url
			},
		},

		created() {
			if(this.question) {
				this.form = JSON.parse(JSON.stringify(this.question));
			}
		}

	}
</script>
<template>
	<div class="card card-header d-flex flex-column">
		<div class="d-flex flex-column justify-content-between align-items-center px-2 py-3 w-100" :class="{'border-bottom': index + 1 !== items.length}" v-for="(item, index) in items">
			<div class="d-flex justify-content-between align-items-center w-100 py-3">
				<div class="d-flex flex-column">
					<h3>{{ item.title }}</h3>
					<p class="mt-1" v-if="item.body">{{ item.body }}</p>
				</div>
				<div class="d-flex align-items-center">
					<a role="button" class="mr-4 pointer" data-toggle="collapse" :href="'#collapse-' + item.id" aria-expanded="false" aria-controls="collapseExample">
						<i class="fa fa-comment fa-2x"></i>
					</a>
					<a role="button" class="mr-4 pointer" @click="deleteItem(item)">
						<i class="fa fa-times fa-2x"></i>
					</a>
					<a :href="'/questions/' + item.id">
						<i class="fa fa-pencil fa-2x"></i>
					</a>
				</div>
			</div>
			
			<div class="collapse w-100" :id="'collapse-' + item.id">
				<div class="d-flex w-100" :class="{'mb-3': item.answers.length == answerIndex + 1}" v-for="(answer, answerIndex) in item.answers" :key="answer.id">
					<div class="d-flex flex-column w-100 border-top mt-3 pt-3 pl-5">
						<div class="d-flex justify-content-between align-items-center mb-3">
							<div class="d-flex align-items-center mr-3">
								<img :src="'/storage/' + answer.author.photo" :alt="answer.author.nickname" class="br-50 mr-2" width="30">
								<i>{{ answer.author.nickname }}</i>
							</div>
							<p class="mb-0">{{ answer.created_at }}</p>
						</div>
						<h5>{{ answer.body }}</h5>
					</div>
				</div>
				<div class="d-flex w-100">
					<input type="text" placeholder="Your comment" class="form-control" v-model="form.body">
					<button class="btn btn-success" @click="send(item.id)">Send</button>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import { required } from 'vuelidate/lib/validators'

	export default {
		name: 'QuestionsList',

		props: ['user', 'questions'],

		data() {
			return {
				items: [],
				disabled: false,
				form: {
					body: null
				}
			}
		},

		validations: {
			form: {
				body: { required }
			}
		},

		computed: {

		},

		mounted() {

		},

		methods: {
			send(question_id) {
				this.$v.form.$touch();
				let isValid = !this.$v.form.$invalid;

				if(isValid) {
					this.disabled = true
					this.form.author_id = this.user.id
					this.form.question_id = question_id

					axios.post('/api/v1/answers', this.form)
					.then(response => {
						this.$swal('Your Answer was sended!', '', 'success')
						this.$set(this, 'form', {
							body: null
						})
					})
					.catch(error => {
									
					})
				}
			},

			deleteItem(item) {
				axios.delete(`/api/v1/questions/${item.id}`)
				.then(response => {
					this.items = response.data
				})
				.catch(error => {
								
				})
			}
		},

		created() {
			this.items = JSON.parse(JSON.stringify(this.questions))
		}
	}
</script>
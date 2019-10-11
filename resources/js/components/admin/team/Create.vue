<template>
	<div class="card card-header">
		<div class="form-group d-flex flex-column align-items-center">
			<img :src="'/storage/' + form.image_url" alt="" width="100" height="100" class="mb-3 br-50">
			<button id="pick-avatar" class="btn btn-info px-4 py-2 rounded">Upload Image</button>
			<avatar-cropper
			@uploaded="handleUploaded"
			trigger="#pick-avatar"
			:labels="cropper.labels"
			output-mime="image/png"
			:output-options="cropper.options"
			:upload-url="'/api/v1/images/teams'"/>
		</div>

		<div class="form-group">
			<label :for="instance + 'title'">Title</label>
			<input type="text" class="form-control" :class="{'error-shadow': $v.form.title.$error}" :id="instance + 'title'" placeholder="Team title" v-model="form.title">
		</div>
		<div class="form-group">
			<label :for="instance + 'subdescription'">Short Description</label>
			<input type="text" class="form-control" :id="instance + 'subdescription'" placeholder="Team short description" v-model="form.subdescription">
		</div>
		<div class="form-group">
			<label :for="instance + 'description'">Description</label>
			<textarea rows="5" type="text" class="form-control" :class="{'error-shadow': $v.form.description.$error}" :id="instance + 'description'" placeholder="Team description" v-model="form.description"></textarea>
		</div>
		<div class="d-flex justify-content-center">
			<button class="btn btn-success" :disabled="disabled" @click="submit">Create</button>
		</div>
	</div>
</template>
<script>
	import { required } from 'vuelidate/lib/validators'
	import AvatarCropper from "vue-avatar-cropper"

	export default {
		name: 'TeamCreate',

		components: {
			AvatarCropper
		},

		props: ['user', 'team'],

		data() {
			return {
				disabled: false,
				instance: 'team-',
				cropper: {
					labels: {
						submit: 'Submit',
						cancel: 'Cancel'
					},
					options: {
						minWidth: 640,
						minHeight: 640,
						maxWidth: 4048,
						maxHeight: 4048,
					}
				},
				form: {
					title: null,
					subdescription: null,
					description: null,
					image_url: 'teams/default-team.png'
				}
			}
		},

		validations: {
			form: {
				title: { required },
				description: { required }
			}
		},

		computed: {

		},

		mounted() {

		},

		methods: {
			submit() {
				this.$v.form.$touch();
				let isValid = !this.$v.form.$invalid;

				if(isValid) {
					this.disabled = true

					if(!this.team) {
						this.form.owner_id = this.user.id

						axios.post('/api/v1/teams', this.form)
						.then(response => {
							this.$swal('Your Team was created!', '', 'success')
							.then((willDelete) => {
								window.location.href = '/teams'
							})
							.catch((willDelete) => {
								window.location.href = '/teams'
							});
							this.disabled = false
						})
						.catch(error => {
							this.$swal(error.response.data.message, '', 'error');
							this.disabled = false		
						})

					} else {
						
						axios.put(`/api/v1/teams/${this.team.id}`, this.form)
						.then(response => {
							this.$swal('Your Team was updated!', '', 'success')
							.then((willDelete) => {
								window.location.href = '/teams'
							})
							.catch((willDelete) => {
								window.location.href = '/teams'
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
			if(this.team) {
				this.form = JSON.parse(JSON.stringify(this.team));
			}
		}

	}
</script>
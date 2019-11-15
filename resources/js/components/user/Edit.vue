<template>
	<div class="card card-header">
		<div class="form-group d-flex flex-column align-items-center">
			<img :src="'/storage/' + form.photo" alt="" width="100" height="100" class="mb-3 br-50">
			<button id="pick-avatar" class="btn btn-info px-4 py-2 rounded">Upload Image</button>
			<avatar-cropper
			@uploaded="handleUploaded"
			trigger="#pick-avatar"
			:labels="cropper.labels"
			output-mime="image/png"
			:upload-headers="cropper.headers"
			:output-options="cropper.options"
			:upload-url="'/api/v1/images/users'"/>
		</div>

		<div class="form-group">
			<label :for="instance + 'nickname'">Nicknickname</label>
			<input type="text" class="form-control" :class="{'error-shadow': $v.form.nickname.$error}" :id="instance + 'nickname'" placeholder="Nickname" v-model="form.nickname">
		</div>
		<div class="form-group">
			<label :for="instance + 'name'">Name</label>
			<input type="text" class="form-control" :class="{'error-shadow': $v.form.name.$error}" :id="instance + 'name'" placeholder="Nickname" v-model="form.name">
		</div>
		<div class="form-group">
			<label :for="instance + 'email'">Email</label>
			<input type="email" class="form-control" :id="instance + 'email'" placeholder="Email" v-model="form.email" readonly>
		</div>
		<div class="form-group">
			<label :for="instance + 'description'">Description</label>
			<textarea class="form-control" :id="instance + 'description'" placeholder="Some info about you" v-model="form.description"></textarea>
		</div>
		<div class="d-flex justify-content-center">
			<button class="btn btn-success" :disabled="disabled" @click="submit">Update</button>
		</div>
	</div>
</template>
<script>
	import { required, email } from 'vuelidate/lib/validators'
	import AvatarCropper from "vue-avatar-cropper"

	export default {
		name: 'UserEdit',

		components: {
			AvatarCropper
		},

		props: ['user'],

		data() {
			return {
				disabled: false,
				instance: 'user-',
				cropper: {
					labels: {
						submit: 'Submit',
						cancel: 'Cancel'
					},
					headers: {
						'Authorization': 'Bearer ' + localStorage.getItem('partyExpToken')
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
					photo: 'users/default-user.png'
				}
			}
		},

		validations: {
			form: {
				nickname: { required },
				name: { required },
				email: { required, email }
			}
		},

		methods: {
			submit() {
				this.$v.form.$touch();
				let isValid = !this.$v.form.$invalid;

				if(isValid) {
					this.disabled = true

						axios.put(`/api/v1/users/${this.user.id}`, this.form)
						.then(response => {
							this.$swal('Your Profile was updated!', '', 'success')
							.then((willDelete) => {
								window.location.href = '/profile'
							})
							.catch((willDelete) => {
								window.location.href = '/profile'
							});
							this.disabled = false
						})
						.catch(error => {
							this.$swal(error.response.data.message, '', 'error');
							this.disabled = false		
						})
				}
			},

			handleUploaded(resp) {
				this.form.photo = resp.image_url
			},
		},

		created() {
			if(this.user) {
				this.form = JSON.parse(JSON.stringify(this.user));
			}
		}

	}
</script>
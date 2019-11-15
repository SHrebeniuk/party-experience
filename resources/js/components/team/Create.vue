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
			:upload-headers="cropper.headers"
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
			<!-- <textarea rows="5" type="text" class="form-control" :class="{'error-shadow': $v.form.description.$error}" :id="instance + 'description'" placeholder="Team description" v-model="form.description"></textarea> -->
			<vue-editor
			:id="instance + 'description'"
			:class="{'error-shadow': $v.form.description.$error}"
			:placeholder="'Team description'"
			v-model="form.description"
			useCustomImageHandler
			@imageAdded="handleImageCategory"></vue-editor>
		</div>
		<div class="d-flex justify-content-center">
			<button class="btn btn-success" :disabled="disabled" @click="submit">
				<template v-if="team">
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
	import AvatarCropper from "vue-avatar-cropper"
	import { VueEditor, Quill } from 'vue2-editor'

	var AlignStyle = Quill.import('attributors/style/align')
	Quill.register(AlignStyle, true);

	export default {
		name: 'TeamCreate',

		components: {
			VueEditor,
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
								window.location.href = '/teams/show/' + this.form.title
							})
							.catch((willDelete) => {
								window.location.href = '/teams/show/' + this.form.title
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
								window.location.href = '/teams/show/' + this.form.title
							})
							.catch((willDelete) => {
								window.location.href = '/teams/show/' + this.form.title
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

			handleImageCategory(file, Editor, cursorLocation) {
				var formData = new FormData();
				formData.append('file', file);
				axios({
					url: '/api/v1/images/teams',
					method: 'POST',
					data: formData
				})
				.then((result) => {
					let url = result.data.image_url
					Editor.insertEmbed(cursorLocation, 'image', url);
				})
				.catch((err) => {
				})
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
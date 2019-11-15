<template>
	<div class="modal fade" id="authModal" tabindex="-1" role="dialog" aria-labelledby="authModalTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<!-- <h5 class="modal-title" id="authModalTitle">You are welcome!</h5> -->
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!-- <div class="d-flex justify-content-around border-bottom mb-4">
						<a role="button">Login</a>
						<strong>|</strong>
						<a role="button">Register</a>
					</div> -->
					<div class="d-flex justify-content-center">
						<div class="col-lg-10">
							<div class="form-group">
								<div class="alert alert-danger w-100 py-2" role="alert" v-if="error">
									Invalid credentials!
								</div>
							</div>
							<div class="form-group">
								<label for="emailLogin">E-Mail Address</label>
								<input id="emailLogin" type="email" class="form-control" :class="{'error-shadow': $v.form.email.$error}" name="email" v-model="form.email" required autocomplete="email" autofocus>
							</div>

							<div class="form-group mb-4">
								<label for="passwordLogin">Password</label>
								<input id="passwordLogin" type="password" class="form-control" :class="{'error-shadow': $v.form.password.$error}" name="password" v-model="form.password" required autocomplete="current-password">
							</div>

							<div class="form-group d-flex flex-column align-items-center">
								<button class="btn btn-primary w-100 mb-3" :disabled="loading" @click="login">Login</button>
								<a class="btn btn-link" href="/password/reset">Forgot Your Password?</a>
							</div>
						</div>

						<form action="/login" method="POST" class="d-none" v-if="">
							<input type="hidden" name="_token" :value="csrf">
							<input type="text" name="email" :value="form.email">
							<input type="text" name="password" :value="form.password">
							<button type="submit" id="submitLogin"></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import { required, minLength, email, sameAs } from 'vuelidate/lib/validators'

	export default {
		name: 'AuthModal',

		props: ['url'],

		data() {
			return {
				csrf: null,
				message: '',
				form: {},
				error: false,
				loading: false,
			}
		},

		validations: {
			form: {
				email: { required, email },
				password: { required }
			}
		},

		mounted () {
			this.csrf = document.head.querySelector('meta[name="csrf-token"]').content
		},

		methods: {
			login () {
				this.$v.form.$touch();
				let isValid = !this.$v.form.$invalid;

				if(isValid) {
					this.loading = true

					axios.post('/api/v1/login', this.form)
					.then(response => {
						let token = response.data.success.token
						localStorage.setItem('partyExpToken', token);
						document.getElementById('submitLogin').click()
						// window.location.href = '/home'
						this.loading = false
					})
					.catch(error => {
						this.loading = false
						this.error = true
					})
				}
			}
		},

		created() {

		}
	}
</script>
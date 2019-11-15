<template>
	<div class="row">
		<div class="col-lg-3 col-xl-3 mb-4" v-for="(item, index) in items" :key="index">
			<div class="card card-header p-0 shadow">
				<img :src="item.image_url" :alt="item.title" class="w-100">

				<div class="p-3">
					<h3>{{ item.title }}</h3>
					<p class="mt-1" v-if="item.subdescription">{{ item.subdescription }}</p>
					<div class="d-flex justify-content-center mt-4">
						<a :href="'/teams/show/' + item.title" class="btn btn-primary text-uppercase py-1 w-100" v-if="teamUser(item)">SHOW</a>
						<button class="btn btn-primary text-uppercase py-1 w-100" @click="join(item.id)" v-else-if="!joined(item)">JOIN</button>
						<button class="btn btn-danger text-uppercase py-1 w-100" @click="decline(item.id)" v-else-if="joined(item)">Decline</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		name: 'AllTeams',

		props: ['teams', 'user'],

		data() {
			return {
				items: [],
				auth: {
					team_recruting: []
				}
			}
		},

		computed: {

		},

		mounted() {

		},

		methods: {
			teamUser(item) {
				return item.id == this.user.team_id ? true : false
			},

			joined (item) {
				for (var i = item.recruits.length - 1; i >= 0; i--) {
					if (item.recruits[i].id == this.user.id) {
						return true
					}
				}
				return false
			},

			decline (id) {
				axios.put(`/api/v1/teams/${id}/join/detach`)
				.then(response => {
					this.$swal('You request was declined!', '', 'success')
					this.$set(this, 'items', response.data)
				})
				.catch(error => {

				})
			},

			join (id) {
				axios.put(`/api/v1/teams/${id}/join/attach`)
				.then(response => {
					this.$swal('You request was sended!', '', 'success')
					this.$set(this, 'items', response.data)
				})
				.catch(error => {

				})
			}
		},

		created() {
			this.items = JSON.parse(JSON.stringify(this.teams));
		}

	}
</script>
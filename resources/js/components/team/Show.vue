<template>
	<div class="card mb-3">
		<div class="card-header d-flex justify-content-between align-items-center">
			<h1>{{ currentTeam.title }}</h1>
			<img :src="'/storage/'+ currentTeam.image_url" alt="" class="br-50" width="80" height="80">
		</div>
		
		<div class="card-header d-flex justify-content-center py-4">
			<a role="button"
			class="pointer text-capitalize"
			:class="{'mr-md-4 mr-lg-5': index + 1 !== tabs.length, 'active': item == tab }"
			v-for="(item, index) in tabs"
			@click="tab = item">{{ item }}</a>
		</div>
		
		<div class="card-header py-4" v-for="item in tabs" v-if="tab == item">
			<!-- Description  -->
			<p class="px-3" v-html="currentTeam.description" v-if="tab == 'description'"></p>

			<!-- Members -->
			<template v-if="tab == 'members'">
				<div class="pb-4 mb-4 border-bottom" v-if="currentTeam.owner_id == user.id && currentTeam.recruits.length > 0">
					<h5 class="mb-3">Recruits</h5>

					<div class="d-flex justify-content-between align-items-center mb-4 px-4" v-for="(item, index) in currentTeam.recruits" :key="index">
						<div class="d-flex align-items-center">
							<img :src="'/storage/'+ item.photo" :alt="item.nickname" class="br-50 mr-4" width="60">
							<div>
								<h3>{{ item.nickname }}</h3>
								<p>{{ item.description }}</p>
							</div>
						</div>
						
						<div class="d-flex">
							<button class="btn btn-success mr-3" @click="updateMembers(item, 'accept')">
								<i class="fa fa-plus"></i>
							</button>
							<button class="btn btn-danger" @click="updateMembers(item, 'decline')">
								<i class="fa fa-times"></i>
							</button>
						</div>
					</div>
				</div>

				<div>
					<h5 class="mb-3" v-if="currentTeam.recruits.length > 0 && currentTeam.owner_id == user.id">Members</h5>

					<div class="d-flex justify-content-between align-items-center pb-4 px-4"
					:class="{'border-bottom mb-4': index !== currentTeam.users.length - 1}"
					v-for="(item, index) in currentTeam.users"
					:key="index">
						<div class="d-flex align-items-center">
							<div class="d-flex flex-column align-items-center mr-4">
								<img :src="'/storage/'+ item.photo" :alt="item.nickname" class="br-50" width="60">
								<i v-if="item.team_role || item.id == currentTeam.owner_id" class="mt-2">
									{{ item.id == currentTeam.owner_id ? 'Owner' : (item.team_role == 1 ? 'Officer' : 'Solder') }}
								</i>
							</div>
							<div>
								<h3>{{ item.nickname }}</h3>
								<p>{{ item.description }}</p>
							</div>
						</div>
						
						<div class="d-flex" v-if="item.id !== user.id">
							<!-- <button class="btn btn-success mr-3">
								<i class="fa fa-envelope"></i>
							</button> -->
							<button class="btn btn-danger" @click="removeMembers(item)">
								<i class="fa fa-times"></i>
							</button>
						</div>
					</div>
				</div>
			</template>
		</div>
	</div>
</template>
<script>
	export default {
		name: 'TeamShow',

		props: ['team', 'user'],

		data() {
			return {
				currentTeam: {
					recruits: []
				},
				tab: 'description',
				tabs: ['description', 'members', 'gallery', 'tasks', 'party', 'schedule', 'FAQ']
			}
		},

		mounted() {

		},

		methods: {
			updateMembers (item, type) {
				axios.put(`/api/v1/teams/${this.currentTeam.id}/member/${item.id}/${type}`)
				.then(response => {
					this.$swal(
						type == 'accept' ? item.nickname + ' was accepted!' : item.nickname + ' was declined!',
						'',
						'success'
					)
					this.$set(this, 'currentTeam', response.data)
				})
				.catch(error => {
				
				})
			},

			removeMembers (item) {
				this.$swal({
					title: 'Are you shure to delete ' + item.nickname + '?',
					text: '',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes!'
				})
				.then((result) => {
					if (result.value) {
						axios.put(`/api/v1/users/${item.id}/remove`)
						.then(response => {
							this.$set(this, 'currentTeam', response.data)
							swal(item.nickname + ' was removed!',
								'',
								'success',
								);
						})
					}
				});
			}
		},

		created() {
			this.currentTeam = JSON.parse(JSON.stringify(this.team));
		}
	}
</script>
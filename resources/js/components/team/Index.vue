<template>
	<div class="card card-header d-flex flex-column">
		<div class="d-flex justify-content-between align-items-center px-2 py-3 w-100" :class="{'border-bottom': index + 1 !== teams.length}" v-for="(item, index) in teams">
			<div class="d-flex align-items-center">
				<img :src="item.image_url" :alt="item.title" class="br-50 mr-4" width="50" height="50">

				<div>
					<h3>{{ item.title }}</h3>
					<p class="mt-1" v-if="item.subdescription">{{ item.subdescription }}</p>
				</div>
			</div>
			<div class="d-flex align-items-center">
				<a :href="'/teams/show/' + item.title" class="mr-4">
					<i class="fa fa-eye fa-2x"></i>
				</a>
				<a :href="'/teams/' + item.id" v-if="item.owner_id == user.id">
					<i class="fa fa-pencil fa-2x"></i>
				</a>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		name: 'TeamsList',

		props: ['teams', 'user'],

		data() {
			return {

			}
		},

		computed: {

		},

		mounted() {

		},

		methods: {

		},

		created() {

		}

	}
</script>
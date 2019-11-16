<template>
	<div class="card card-header d-flex flex-column">
		<template v-if="items.length > 0">
			<div class="d-flex justify-content-between align-items-center px-2 py-3 w-100"
			:class="{'border-bottom': index + 1 !== items.length}"
			v-for="(item, index) in items"
			:key="index">
				<div class="d-flex align-items-center">
					<img :src="'/storage/' + item.image_url" :alt="item.title" class="br-50 mr-3" width="60">
					<div class="d-flex align-items-center">
						<h3>{{ item.title }}</h3>
						<p class="mt-1" v-if="item.subdescription">{{ item.subdescription }}</p>
					</div>
				</div>
				<div class="d-flex align-items-center">
					<a role="button" class="mr-4 pointer" @click="deleteItem(item)">
						<i class="fa fa-times fa-2x"></i>
					</a>
					<a :href="'/categories/' + item.id">
						<i class="fa fa-pencil fa-2x"></i>
					</a>
				</div>
			</div>
		</template>

		<div class="d-flex justify-content-center align-items-center px-2 py-3 w-100" v-else>
			<h3>Empty list</h3>
		</div>
	</div>
</template>
<script>
	export default {
		name: 'CategoriesList',

		props: ['categories'],

		data() {
			return {
				items: []
			}
		},

		computed: {

		},

		mounted() {

		},

		methods: {
			deleteItem(item) {
				axios.delete(`/api/v1/categories/${item.id}`)
				.then(response => {
					this.items = response.data
				})
				.catch(error => {
								
				})
			}
		},

		created() {
			this.items = JSON.parse(JSON.stringify(this.categories));
		}

	}
</script>
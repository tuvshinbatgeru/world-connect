<template>
	<div class="university">
		<table>
			<tr>
				<td class="university-img">
					<div class="cover-img">
						<img class="fit" :src="item.logo_url"/>
					</div>
				</td>
			</tr>
			<tr>
				<td class="university-name table--cell">
					{{item.name}}
				</td>
			</tr>
		</table>

	</div>
</template>
<script>

	export default {
		props : {
			item: {
				required : true
			}
		},
	}
</script>

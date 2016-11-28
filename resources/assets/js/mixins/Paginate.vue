<template>
  <ul class="pagination" v-show="totalPage > 1"> 
    <li v-show="pageIndex > 1">
      <a @click="resetPage()" aria-label="First Page">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li> 
    <li v-show="pageIndex > 1">
      <a @click="prevPage()" aria-label="Previous">
        <span aria-hidden="true">&lsaquo;</span>
      </a>
    </li> 

    <li v-for="n in pages" :class="isActive(n)">
        <a @click="toPage(n)">{{n}}</a>
    </li>

    <!-- <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>  -->
    <li v-show="pageIndex < totalPage">
      <a @click="nextPage()" aria-label="Next">
        <span aria-hidden="true">&rsaquo;</span>
      </a>
    </li> 
    <li v-show="pageIndex < totalPage">
      <a @click="lastPage()" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li> 
  </ul>
</template>
<script>
  export default {
    props : {
        paginate : {
          type : Number,
          default : 5
        },

        offset: {
          type: Number,
          default : 3
        },

        total : {
          type: Number,
          required : true
        }
    },

    data () {
      return {
          pageIndex : 1,
      }
    },

    created : function () {
        this.resetPage()
    },

    methods: {
        
        resetPage : function () {
            this.pageIndex = 1
            this.$emit('page-changed', this.pageIndex)
        },

        lastPage : function () {
            this.pageIndex = this.totalPage
            this.$emit('page-changed', this.pageIndex)
        },

        nextPage : function () {
            this.pageIndex ++
            this.$emit('page-changed', this.pageIndex)
        },

        prevPage : function () {
            this.pageIndex --
            this.$emit('page-changed', this.pageIndex)
        },

        toPage : function (page) {
            this.pageIndex = page
            this.$emit('page-changed', this.pageIndex)
        },

        isActive : function (index) {
            return this.pageIndex == index ? 'active' : ''
        }
    }, 

    computed : {
        totalPage : function () {
            var totalPage = Math.ceil(this.total / this.paginate)
            return totalPage
        },

        pages : function () {
            var from = this.pageIndex - this.offset

            if (from < 1) {
                from = 1
            }

            var to = from + (this.offset * 2)

            if (to >= this.totalPage) {
                to = this.totalPage;
            }            

            var pages = _.range(from, to + 1)
            return pages
        },
    }

  }
</script>

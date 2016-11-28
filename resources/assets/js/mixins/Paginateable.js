export default {
  props : {
    loading : {
      type : Boolean,
      default : false
    }
  },

  data () {
    return {
        pageIndex : 1,
        pageLast : 0,
        total : {},
    }
  },

  methods: {
      resetPage : function () {
          this.pageIndex = 1
      }
  }
}

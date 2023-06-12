const Mark = {
    // state
    data () {
      return {
        count: 0
      }
    },
    // view
    template: `
      <div>{{ count }}</div>
    `,
    // actions
    methods: {
      increment () {
        this.count++
      }
    }
  }

  export default {
    Mark
  };
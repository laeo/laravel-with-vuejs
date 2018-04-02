<template>
  <div>
    fucking homepage!

    <ul>
      <li v-for="u in users" :key="u.id">{{ u.email }}</li>
    </ul>
  </div>
</template>

<script>
  // import { mapState } from 'vuex'
  import users from '@/api/users'

  export default {
    name: 'Home',
    data () {
      return {
        users: []
      }
    },
    mounted () {
      users.index().then(m => {
        this.users = m
      })
    }
  }
</script>
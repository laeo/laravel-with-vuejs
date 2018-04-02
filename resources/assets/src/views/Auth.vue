<template>
  <div>
    <h1>Auth Form</h1>
    <p v-if="this.message.length > 0">{{ this.message }}</p>
    <div>
      <b>账号</b> <input v-model="email" type="email" name="email">
    </div>
    <div>
      <b>密码</b> <input v-model="password" type="password" name="password">
    </div>
    <div>
      <button @click="handleSubmit">确认</button> <router-link to="/">Back</router-link>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'Auth',
    data () {
      return {
        message: '',
        email: '',
        password: ''
      }
    },
    methods: {
      handleSubmit () {
        this.$store
          .dispatch('authenticate', {email: this.email, password: this.password})
          .then(m => {
            this.$router.push('home')
          })
          .catch(e => {
            switch (e.status) {
              case 400:
                this.message = e.data.message
                break
            }
          })
      }
    },
    beforeMount () {
      if (this.$store.isAuthenticated) {
        this.$router.push('home');
      }
    }
  }
</script>
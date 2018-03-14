<template>
  <div class="container">
    <div class="row">

      <div class="col-md-8 offset-md-2">
        <div class="alert alert-info">
          Tutorial pembuatan fitur ini dapat dibaca pada tulisan <a href="https://wp.me/p7UAso-7H">Membuat Fitur "Load More" di Laravel Menggunakan VueJS</a>.
        </div>

      <div class="card card-default">
        <div class="card-header"><h3>Users</h3></div>
        <div class="card-body no-padding">
          <table v-if="users.data" class="table table-responsive table-hover">
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Created</th>
              <th>Updated</th>
            </tr>

            <tbody>
              <tr v-for="(user, index) in users.data">
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.created_at }}</td>
                <td>{{ user.updated_at }}</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div v-if="users.next_page_url" class="card-footer">
          <button @click.prevent="paginate(users.next_page_url)" type="button" class="btn btn-primary btn-block">Load More</button>
        </div>
      </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'UserIndex',

    data() {
      return {
        users: {}
      }
    },

    mounted() {
      this.paginate()
    },

    methods: {
      paginate(url = '') {
        axios.get(url ? url : 'api/user')
          .then(response => {  
            if (! this.users.data) {
              this.users = response.data
            }
            else {
              this.users.data.push(...response.data.data)
              this.users.next_page_url = response.data.next_page_url
            }
          })
          .catch(e => console.error(e))
      }
    }
  }
</script>
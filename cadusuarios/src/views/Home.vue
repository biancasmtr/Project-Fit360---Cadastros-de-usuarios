<template>
    <div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Primeiro</th>
            <th scope="col">Último</th>
            <th scope="col">Nickname</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>Larry</td>
            <td>the Bird</td>
            <td>@twitter</td>
          </tr>
        </tbody>
      </table>

      <button type="button" class="btn btn-primary">
        <router-link to="login">  Logout</router-link>
      </button>
    </div>
</template>

<script>

export default {
    name: "home",
    data() {
        return {

        }
    }
}
</script>

<style>

  .table {
    width: 70%;
    margin: 0 auto;
    margin-top: 5%;
  }
</style>

<template lang="html">

  <section class="tables">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Sortable Table</h4>
            <p class="card-description">
              Bootstrap contextual state applied to the row and column
            </p>
            <b-table striped hover responsive :items="items" :fields="fields"></b-table>
          </div>
        </div>
      </div>
    </div>
  </section>

</template>

<script lang="js">
export default {
  name: 'tables',
  data () {
    return {
      items: [
        { isActive: true, age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
        { isActive: false, age: 21, first_name: 'Larsen', last_name: 'Shaw' },
        { isActive: false, age: 89, first_name: 'Geneva', last_name: 'Wilson' },
        { isActive: true, age: 38, first_name: 'Jami', last_name: 'Carney' }
      ],
      fields: {
        last_name: {
          label: 'Person last name',
          sortable: true
        },
        first_name: {
          label: 'Person first name',
          sortable: false
        },
        foo: {
          // This key overrides `foo`!
          key: 'age',
          label: 'Person age',
          sortable: true
        }
      }
    }
  }
}
</script>

<style scoped lang="scss">
.tables {

}
</style>

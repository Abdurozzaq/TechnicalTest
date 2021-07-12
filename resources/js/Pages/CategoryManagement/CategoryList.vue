<template>

  <layout title="List of Category - Dashboard">
    <page-title title="List of Category" subtitle="Here you can see goods categories data" />

    <v-row>
      <v-col cols="12">
        <v-card class="mx-8 my-2" color="white" rounded="xl">
          <v-card-title>
            <v-text-field
              v-model="search"
              append-icon="mdi-magnify"
              label="Search"
              single-line
              hide-details
            ></v-text-field>
          </v-card-title>
          <v-data-table
            :headers="headers"
            :items="data"
            :search="search"
          >
            <template v-slot:[`item.action`]="{ item }">
              <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                  <v-btn v-bind="attrs" v-on="on" class="ma-2" fab dark small color="#4DC294" @click.prevent="openEditDialog(item)">
                    <v-icon dark>mdi-tooltip-edit</v-icon>
                  </v-btn>      
                </template>
                <span>Edit Item</span>
              </v-tooltip>

              <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                  <v-btn v-bind="attrs" v-on="on" class="ma-2" fab dark small color="error" @click.prevent="openDeleteDialog(item.id)">
                    <v-icon dark>mdi-trash-can-outline</v-icon>
                  </v-btn>
                </template>
                <span>Delete Item</span>
              </v-tooltip>
            </template>
          </v-data-table>
        </v-card>
      </v-col>
    </v-row>

    <!-- POP UP MENU FOR EDITING -->
    <v-dialog v-model="editDialog" persistent fullscreen hide-overlay transition="dialog-bottom-transition">
      <v-card>
        <v-toolbar dark class="dash-card-title-bg">
          <v-btn icon dark @click="editDialog = false">
            <v-icon>mdi-close</v-icon>
          </v-btn>
          <v-toolbar-title>Edit Category</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items>
            <v-btn dark text @click="editSave()">Save</v-btn>
          </v-toolbar-items>
        </v-toolbar>
        <v-card-text class="mt-10">
          <v-row>
            <v-col cols="12">

              <v-row>
                <v-col cols="12" lg="6" md="12" sm="12">
                  <v-text-field
                    label="Category Name"
                    hint="Required"
                    persistent-hint
                    single-line
                    filled
                    :error-messages="errors.category_name"
                    v-model="editData.category_name"
                  ></v-text-field>

                  <v-text-field
                    label="Description"
                    hint="Required"
                    persistent-hint
                    single-line
                    filled
                    :error-messages="errors.category_description"
                    v-model="editData.category_description"
                  ></v-text-field>

                </v-col>
              </v-row>
            </v-col>
          </v-row>
        </v-card-text>
      </v-card>
    </v-dialog>

    <!-- DELETE POP UP -->
    <v-dialog
      v-model="deleteItemDialog"
      persistent
      max-width="290"
    >
      <v-card>
        <v-card-title class="headline">
          Delete This Category?
        </v-card-title>
        <v-card-text>Remember you cannot undo this action.</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="green darken-1"
            text
            @click="deleteItemDialog = false"
          >
            Cancel
          </v-btn>
          <v-btn
            color="error"
            text
            @click="deleteItem()"
          >
            Yes, Delete!
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-snackbar
      v-model="successSnackbar"
      :timeout="5000"
      :color="successSnackbarColor"
    >
      {{ successSnackbarText }}

      <template v-slot:action="{ attrs }">
        <v-btn
          color="white"
          text
          v-bind="attrs"
          @click="successSnackbar = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>
  </layout>
</template>

<script>
  import Layout from '../Layouts/MainLayout.vue'
  import PageTitle from '../../components/PageTitle.vue'
  export default {
    components: {
      Layout,
      PageTitle
    },

    props: {
      data: Array,
      errors: Object
    },

    data() {
      return {
        search: '',
        headers: [
          {
            text: 'Category Name',
            align: 'start',
            filterable: true,
            value: 'category_name',
          },
          {
            text: 'Description',
            align: 'start',
            filterable: true,
            value: 'category_description',
          },
          {
            text: 'Action',
            align: 'start',
            filterable: false,
            value: 'action',
          },
        ],
        editDialog: false,
        editData: {
          id: "",
          category_name: "",
          category_description: "",
        },
        deleteItemDialog: false,
        deleteData: {
          id: ""
        },
        successSnackbar: false,
        successSnackbarColor: '',
        successSnackbarText: "",
      }
    }, // End of Data

    methods: {
      openEditDialog: function (item) {
        let currentObj = this
        currentObj.editData.id = item.id
        currentObj.editData.category_name = item.category_name
        currentObj.editData.category_description = item.category_description
        currentObj.editDialog = true
      },
      editSave() {
        let currentObj = this

        var data = new FormData()
        data.append('id', currentObj.editData.id || '')
        data.append('category_name', currentObj.editData.category_name || '')
        data.append('category_description', currentObj.editData.category_description || '')

        currentObj.$inertia.post('/category/list/edit', data, {
          onSuccess: () => {
            currentObj.editDialog = false
            currentObj.successSnackbar = true
            currentObj.successSnackbarColor = 'green'
            currentObj.successSnackbarText = "Category Data has been Changed!"
          }
        })
      },
      openDeleteDialog: function (id) {
        let currentObj = this
        currentObj.deleteData.id = id
        currentObj.deleteItemDialog = true
      },
      deleteItem() {
        let currentObj = this

        currentObj.$inertia.post('/category/list/delete', {id: currentObj.deleteData.id}, {
          onSuccess: () => {
            currentObj.deleteItemDialog = false
            currentObj.successSnackbar = true
            currentObj.successSnackbarColor = 'green'
            currentObj.successSnackbarText = "Category has been Deleted!"
          }
        })
      },
    },
  }
</script>

<style scoped>
  .dash-card-title-bg {
    background: rgb(89,120,243);
    background: linear-gradient(90deg, rgba(89,120,243,1) 0%, rgba(91,103,247,1) 100%);
  }
</style>
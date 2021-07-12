<template>
  <layout title="List of Goods - Dashboard">

    <page-title title="List of Goods" subtitle="Here you can see goods data" />

    <v-row>
      <v-col cols="12">
        <v-card class="mx-8 my-2" col="xl">
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
            :items="data.goods"
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
          <v-toolbar-title>Edit Goods</v-toolbar-title>
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
                    label="Goods Name"
                    hint="Required"
                    persistent-hint
                    single-line
                    filled
                    :error-messages="errors.goods_name"
                    v-model="editData.goods_name"
                  ></v-text-field>

                  <v-select
                    label="Category"
                    hint="Required"
                    filled
                    dense
                    v-model="editData.category_id"
                    :items="data.categories"
                    item-text="state"
                    item-value="abbr"
                    :error-messages="errors.category_id"
                  ></v-select>

                  <v-text-field
                    label="Goods Quantity"
                    hint="Required"
                    persistent-hint
                    single-line
                    filled
                    :error-messages="errors.goods_qty"
                    v-model="editData.goods_qty"
                  ></v-text-field>

                  <v-textarea
                    label="Description"
                    hint="Required"
                    filled
                    dense
                    type="text"
                    v-model="editData.goods_description"
                    :error-messages="errors.goods_description"
                  ></v-textarea>
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
          Delete This Unit?
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
      data: Object,
      errors: Object
    },

    data() {
      return {
        search: '',
        headers: [
          {
            text: 'Goods Name',
            align: 'start',
            filterable: true,
            value: 'goods_name',
          },
          {
            text: 'Category',
            align: 'start',
            filterable: true,
            value: 'category.category_name',
          },
          {
            text: 'Quantity',
            align: 'start',
            filterable: true,
            value: 'goods_qty',
          },
          {
            text: 'Description',
            align: 'start',
            filterable: true,
            value: 'goods_description',
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
          goods_name: "",
          category_id: "",
          goods_qty: "",
          goods_description: "",
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
        currentObj.editData.goods_name = item.goods_name
        currentObj.editData.category_id = item.category.id
        currentObj.editData.goods_qty = item.goods_qty
        currentObj.editData.goods_description = item.goods_description
        currentObj.editDialog = true
      },
      editSave() {
        let currentObj = this

        var data = new FormData()
        data.append('id', currentObj.editData.id || '')
        data.append('goods_name', currentObj.editData.goods_name || '')
        data.append('category_id', currentObj.editData.category_id || '')
        data.append('goods_qty', currentObj.editData.goods_qty || '')
        data.append('goods_description', currentObj.editData.goods_description || '')

        currentObj.$inertia.post('/goods/list/edit', data, {
          onSuccess: () => {
            currentObj.editDialog = false
            currentObj.successSnackbar = true
            currentObj.successSnackbarColor = 'green'
            currentObj.successSnackbarText = "Goods Data has been Changed!"
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

        currentObj.$inertia.post('/goods/list/delete', {id: currentObj.deleteData.id}, {
          onSuccess: () => {
            currentObj.deleteItemDialog = false
            currentObj.successSnackbar = true
            currentObj.successSnackbarColor = 'green'
            currentObj.successSnackbarText = "Goods has been Deleted!"
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
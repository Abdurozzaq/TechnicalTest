<template>
  <layout title="Create Goods - Dashboard">

    <page-title title="Create Goods" subtitle="Here you can add new goods" />
    
    <v-container>
      <v-row>
        <v-col cols="12">
          <v-card class="mx-auto mx-sm-8 mx-md-8 mx-lg-8 mx-xl-8 my-2" :width="$vuetify.breakpoint.smAndDown ? '80%' : '720px'" color="white" rounded="xl">
            <v-card-text>
              <v-form @submit.prevent="formSubmit()" class="ma-5">
                <v-row>
                  <v-col cols="12" sm="12" md="12" lg="12" xl="12">
                    <v-text-field
                      label="Goods Name"
                      hint="Required"
                      filled
                      dense
                      type="text"
                      rounded
                      v-model="form.goods_name"
                      :error-messages="form.errors.goods_name"
                    ></v-text-field>

                    <v-select
                      label="Category"
                      hint="Required"
                      filled
                      dense
                      rounded
                      v-model="form.category_id"
                      :items="data.categories"
                      item-text="state"
                      item-value="abbr"
                      :error-messages="form.errors.category_id"
                    ></v-select>

                    <v-text-field
                      label="Goods Quantity"
                      hint="Required"
                      filled
                      dense
                      type="text"
                      rounded
                      v-model="form.goods_qty"
                      :error-messages="form.errors.goods_qty"
                    ></v-text-field>


                    <v-textarea
                      label="Description"
                      hint="Required"
                      filled
                      dense
                      type="text"
                      rounded
                      v-model="form.goods_description"
                      :error-messages="form.errors.goods_description"
                    ></v-textarea>
                  </v-col>
                </v-row>

                <v-btn
                  color="#4E48FC"
                  :loading="form.processing"
                  :disabled="form.processing"
                  class="white--text"
                  large
                  rounded
                  type="submit"
                >
                  Create Goods
                </v-btn>
              </v-form>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
    

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
        successSnackbar: false,
        successSnackbarColor: '',
        successSnackbarText: "",
        form: this.$inertia.form({
          goods_name: "",
          category_id: "",
          goods_qty: "",
          goods_description: "",
        }),
      }
    }, // end of data()

    methods: {
      formSubmit() {
        const currentObj = this
        currentObj.form.clearErrors()
        currentObj.form.post('/goods/create/send', {
          onSuccess: () => {
            currentObj.successSnackbar = true
            currentObj.successSnackbarColor = 'green'
            currentObj.successSnackbarText = "Goods has been created!"
            currentObj.form.goods_name = ""
            currentObj.form.category_id = ""
            currentObj.form.goods_qty = ""
            currentObj.form.goods_description = ""
          },
          onError: () => {
          }
        })
      },
    }
  }
</script>
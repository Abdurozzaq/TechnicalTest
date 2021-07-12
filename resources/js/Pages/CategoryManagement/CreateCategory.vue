<template>
  <layout title="Create Category - Dashboard">

    <page-title title="Create Category" subtitle="Here you can add new category" />
    
    <v-container>
      <v-row>
        <v-col cols="12">
          <v-card class="mx-auto mx-sm-8 mx-md-8 mx-lg-8 mx-xl-8 my-2" :width="$vuetify.breakpoint.smAndDown ? '80%' : '720px'" color="white" rounded="xl">
            <v-card-text>
              <v-form @submit.prevent="formSubmit()" class="ma-5">
                <v-row>
                  <v-col cols="12" sm="12" md="12" lg="12" xl="12">
                    <v-text-field
                      label="Category Name"
                      hint="Required"
                      filled
                      dense
                      type="text"
                      rounded
                      v-model="form.category_name"
                      :error-messages="form.errors.category_name"
                    ></v-text-field>

                    <v-textarea
                      label="Description"
                      hint="Required"
                      filled
                      dense
                      type="text"
                      rounded
                      v-model="form.category_description"
                      :error-messages="form.errors.category_description"
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
                  Create Category
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

    data() {
      return {
        successSnackbar: false,
        successSnackbarColor: '',
        successSnackbarText: "",
        form: this.$inertia.form({
          category_name: "",
          category_description: "",
        }),
      }
    }, // end of data()

    methods: {
      formSubmit() {
        const currentObj = this
        currentObj.form.clearErrors()
        currentObj.form.post('/category/create/send', {
          onSuccess: () => {
            currentObj.successSnackbar = true
            currentObj.successSnackbarColor = 'green'
            currentObj.successSnackbarText = "Category has been created!"
            currentObj.form.category_name = ""
            currentObj.form.category_description = ""
          },
          onError: () => {
            currentObj.form.category_name = ""
            currentObj.form.category_description = ""
          }
        })
      },
    }
  }
</script>
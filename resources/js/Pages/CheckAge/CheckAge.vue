<template>
  <layout title="Check Age - Dashboard">

    <page-title title="Check Usia Anda" subtitle="Check sebutan untuk umur anda" />
    
    <v-container>
      <v-row>
        <v-col cols="12">
          <v-card class="mx-auto mx-sm-8 mx-md-8 mx-lg-8 mx-xl-8 my-2" :width="$vuetify.breakpoint.smAndDown ? '80%' : '720px'" color="white" rounded="xl">
            <v-card-text>
              <v-form class="ma-5">
                <v-row>
                  <v-col cols="12" sm="12" md="12" lg="12" xl="12">
                    <v-text-field
                      label="Umur"
                      hint="Required"
                      required
                      filled
                      dense
                      type="text"
                      rounded
                      v-model="umur"
                      :error-messages="umurError"
                    ></v-text-field>
                  </v-col>
                </v-row>

                <v-btn
                  color="#4E48FC"
                  class="white--text"
                  large
                  rounded
                  type="submit"
                  @click.prevent="calculate()"
                >
                  Calculate
                </v-btn>

                <v-btn
                  color="grey"
                  class="white--text ml-2"
                  large
                  rounded
                  type="submit"
                  @click.prevent="umurError = '',  umur = ''"
                >
                  Clear
                </v-btn>
              </v-form>



              <div class="text-center mt-2" v-show="result">
                <v-divider></v-divider>
                <h2 class="mb-2 mt-3">Result:</h2>
                <h1>{{result}}</h1>
              </div>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
    
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
        umur: "",
        umurError: "",
        result: ""
      }
    }, // end of data()

    methods: {
      calculate() {
        let currentObj = this
      
        if(!currentObj.umur) {

          currentObj.umurError = "Age is Required"

        } else {

          if (currentObj.umur<=18) {

            if (currentObj.umur<=10){

              currentObj.result = "Anak-Anak"

            } else {

             currentObj.result = "Remaja"

            }

          } else {

            currentObj.result = "Bukan usia anak maupun remaja"

          }

        }
      },
    }
  }
</script>
<template>
  <layout title="String Input Check - Dashboard">

    <page-title title="String Input Check" subtitle="String Input Check Here" />
    
    <v-container>
      <v-row>
        <v-col cols="12">
          <v-card class="mx-auto mx-sm-8 mx-md-8 mx-lg-8 mx-xl-8 my-2" :width="$vuetify.breakpoint.smAndDown ? '80%' : '720px'" color="white" rounded="xl">
            <v-card-text>
              <v-form class="ma-5">
                <v-row>
                  <v-col cols="12" sm="12" md="12" lg="12" xl="12">
                    <v-text-field
                      label="Input 1"
                      hint="Required"
                      required
                      filled
                      dense
                      type="text"
                      rounded
                      v-model="input1"
                      :error-messages="input1Error"
                    ></v-text-field>

                    <v-text-field
                      label="Input 2"
                      hint="Required"
                      required
                      filled
                      dense
                      type="text"
                      rounded
                      v-model="input2"
                      :error-messages="input2Error"
                    ></v-text-field>
                  </v-col>
                </v-row>

                <v-btn
                  color="#4E48FC"
                  class="white--text"
                  large
                  rounded
                  type="submit"
                  @click.prevent="find()"
                >
                  Send
                </v-btn>

                <v-btn
                  color="grey"
                  class="white--text ml-2"
                  large
                  rounded
                  type="submit"
                  @click.prevent="input1Error = '', input2Error = '', input1 = '', input2 = ''"
                >
                  Clear
                </v-btn>
              </v-form>



              <div class="text-center mt-2" v-show="result">
                <v-divider></v-divider>
                <h2 class="mb-2 mt-3">Result:</h2>
                <h1>{{result}}%</h1>
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
        input2: "",
        input2Error: "",
        input1: "",
        input1Error: "",
        result: ""
      }
    }, // end of data()

    methods: {
      removeDoubleChar(string) {
        return string
          .split('')
          .filter(function(item, pos, self) {
            return self.indexOf(item) == pos;
          })
          .join('');
      },

      find() {
        let currentObj = this

        if(currentObj.input1 == "") {
          currentObj.input1Error = "Input1 is Required"
        }

        if(currentObj.input2 == "") {
          currentObj.input2Error = "Input2 is Required"
        }

        let input1 = currentObj.input1
        let input2 = currentObj.input2

        let input1Filtered = currentObj.removeDoubleChar(input1)

        let qty = 0

        for (const item of input1Filtered) {
          for (const item2 of input2) {
            if ( item.includes(item2) ) {
              qty++
            }
          }
        }

        currentObj.result = qty / input1.length * 100
      },
    }
  }
</script>
<template>
  <layout title="Create Category - Dashboard">

    <page-title title="Kalulator Ongkir Progresif" subtitle="Hitung Ongkir disini" />
    
    <v-container>
      <v-row>
        <v-col cols="12">
          <v-card class="mx-auto mx-sm-8 mx-md-8 mx-lg-8 mx-xl-8 my-2" :width="$vuetify.breakpoint.smAndDown ? '80%' : '720px'" color="white" rounded="xl">
            <v-card-text>
              <v-form class="ma-5">
                <v-row>
                  <v-col cols="12" sm="12" md="12" lg="12" xl="12">
                    <v-text-field
                      label="Item Quantity"
                      hint="Required"
                      required
                      filled
                      dense
                      type="text"
                      rounded
                      v-model="item_qty"
                      :error-messages="qtyError"
                    ></v-text-field>

                    <v-text-field
                      label="Price Per Kg"
                      hint="Required"
                      required
                      filled
                      dense
                      type="text"
                      rounded
                      v-model="price_per_kg"
                      :error-messages="priceError"
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
                  @click.prevent="qtyError = '', priceError = '', item_qty = '', price_per_kg = ''"
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
        price_per_kg: "",
        priceError: "",
        item_qty: "",
        qtyError: "",
        result: ""
      }
    }, // end of data()

    methods: {
      calculate() {
        let currentObj = this

        if(!currentObj.item_qty) {
          currentObj.qtyError = "Quantity is Required"
        }

        if(!currentObj.price_per_kg) {
          currentObj.priceError = "Price is Required"
        }

        currentObj.result = currentObj.item_qty * currentObj.price_per_kg

      },
    }
  }
</script>
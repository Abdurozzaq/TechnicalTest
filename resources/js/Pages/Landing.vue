<template>
  <v-app>
    <v-app-bar
      app
      flat
      height="72"
      color="transparent"
      hide-on-scroll
    >
      <v-toolbar-title class="white--text">CODING TEST HASHMICRO</v-toolbar-title>

      <v-spacer></v-spacer>

      <inertia-link href="/">
        <v-btn
          outlined
          rounded
          color="white"
          class="mx-2"
        >
          LOGIN
        </v-btn>
      </inertia-link>
      
    </v-app-bar>

    <v-main class="pt-0">
      <div class="landing-bg-gradient fill-height">

        <v-container
          fluid
          class="fill-height py-0"
        >
          <v-row>
            <v-col
              cols="12"
            >
              <v-card
                width="350px"
                color="rgba(155, 175, 253, 0.65)"
                class="elevation-0 mx-auto rounded-xl pa-5"
              >
                <v-card-text class="text-center">
                  <div class="text-h4 font-weight-bold white--text">Welcome To My App</div>
                  <div class="text-h6 font-weight-bold white--text">Sign In To Your Account</div>
                </v-card-text>

                <v-card-text class="text-center">
                  <v-alert
                    dense
                    type="success"
                    class="mx-5"
                    border="left"
                    colored-border
                    v-if="form.wasSuccessful"
                  >
                    <div class="float-left text-caption mr-auto">Success! Please wait...</div> 
                  </v-alert>

                  <v-alert
                    dense
                    type="error"
                    class="mx-5"
                    border="left"
                    colored-border
                    v-if="form.hasErrors"
                  >
                    <div class="float-left text-caption mr-auto">Sorry, there was an error</div> 
                  </v-alert>

                  <v-form @submit.prevent="submit()">
                    <v-text-field
                      label="Email"
                      filled
                      dense
                      class="mx-5 custom-error-color"
                      type="email"
                      dark
                      v-model="form.email"
                      :error-messages="form.errors.email"
                    ></v-text-field>

                    <v-text-field
                      label="Password"
                      filled
                      dense
                      class="mx-5 custom-error-color"
                      type="password"
                      dark
                      v-model="form.password"
                      :error-messages="form.errors.password"
                    ></v-text-field>
                  
                    <v-btn
                      rounded
                      color="white"
                      width="90%"
                      class="mb-3 mt-3"
                      type="submit"
                      elevation="0"
                      :loading="form.processing"
                      :disabled="form.processing"
                    >
                      <div class="font-weight-bold deep-purple--text">LOGIN</div>
                    </v-btn>
                  </v-form>
                </v-card-text>
              </v-card>

              <div class="white--text text-caption my-2 text-center">Copyright 	&copy;{{ new Date().getFullYear() }} Abdurozzaq.</div>
            </v-col>
          </v-row>
        </v-container>
      </div>
    </v-main>
  </v-app>
</template>

<script>
  export default {

    data() {
      return {
        form: this.$inertia.form({
          email: "",
          password: "",
        }),
      }
    }, // end of data()

    methods: {
      submit() {
        const currentObj = this
        currentObj.form.clearErrors()
        currentObj.form.post('/login', {
          onSuccess: () => currentObj.form.reset('password'),
        })
      }
    }
  }
</script>

<style scoped>
.landing-bg-gradient {
  background: rgb(93,84,255);
  background: linear-gradient(322deg, #5d54ff 24%, #488bee 100%);
}

::v-deep .custom-error-color .error--text,
::v-deep .custom-error-color .error--text {
  color: #ff8686 !important;
  caret-color: #ff8686 !important;
}

.logo-text-font {
  font-family: "Paytone One";
}
</style>
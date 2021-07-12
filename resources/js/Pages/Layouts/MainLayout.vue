<template>
  <v-app id="inspire">
    <v-app-bar
      app
      color="#334257"
      flat
    >
      <v-container class="py-0 fill-height">
        <v-app-bar-nav-icon class="white--text" @click.stop="leftSideBar = !leftSideBar"></v-app-bar-nav-icon>

        <v-spacer></v-spacer>

        <inertia-link href="/logout" method="post" as="span">
          <v-btn
            color="#EEEEEE"
            class="mx-2"
          >
            LOGOUT
          </v-btn>
        </inertia-link>
      </v-container>
    </v-app-bar>

    <v-navigation-drawer
      app
      absolute
      color="#F6F5FA"
      floating
      v-model="leftSideBar"
    >
      <h4 class="my-4 text-center">CODING TEST</h4>

      <v-divider class="mx-3 mb-5 mt-0"></v-divider>

      <v-list nav>
        <div
          v-for="(item, i) in sidebarItems"
          :key="i"
        >
          <v-list-group
            v-if="item.sub"
            no-action
          >
            <v-icon slot="prependIcon" class="text-warna">{{ item.icon }}</v-icon>

            <template v-slot:activator>
              <v-list-item-content>
                <v-list-item-title class="text-warna font-weight-bold" v-text="item.title"></v-list-item-title>
              </v-list-item-content>
            </template>
            <div
              v-for="(child, c) in item.sub"
              :key="c"
            >
              <inertia-link :href="child.url">
                <v-tooltip right>
                  <template v-slot:activator="{ on, attrs }">
                    <v-list-item
                      link
                      v-bind="attrs"
                      v-on="on"
                    >
                      <v-list-item-title class="text-warna font-weight-bold text-warna">
                        {{ child.title }}
                      </v-list-item-title>
                    </v-list-item>
                  </template>
                  <span>{{ child.title }}</span>
                </v-tooltip>
              </inertia-link>
            </div>
          </v-list-group>

          <div
            v-if="item.sub == false"
          >
            <inertia-link :href="item.url">
              <v-tooltip right>
                <template v-slot:activator="{ on, attrs }">
                  <v-list-item
                    link
                    v-bind="attrs"
                    v-on="on"
                  >
                    <v-list-item-icon>
                      <v-icon class="text-warna" v-text="item.icon"></v-icon>
                    </v-list-item-icon>

                    <v-list-item-title class="text-warna font-weight-bold text-warna">
                      {{ item.title }}
                    </v-list-item-title>
                  </v-list-item>
                </template>
                <span>{{ item.title }}</span>
              </v-tooltip>
            </inertia-link>
          </div>
        </div>
      </v-list>
    </v-navigation-drawer>

    <v-main class="grey lighten-3">
      <v-container>
        <slot />
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      leftSideBar: true,
      sidebarItems: [
          { 
            title: 'Dashboard', 
            icon: 'mdi-view-dashboard-outline' ,
            url: '/dash',
            sub: false
          },
          { 
            title: 'Calculate Shipping Cost', 
            icon: 'mdi-calculator' ,
            url: '/calculator',
            sub: false
          },
          { 
            title: 'Input Check', 
            icon: 'mdi-check' ,
            url: '/input-check',
            sub: false
          },
          { 
            title: 'Age Check', 
            icon: 'mdi-check' ,
            url: '/age-check',
            sub: false
          },
          { 
            title: 'Category', 
            icon: 'mdi-shape-outline',
            sub: [
              { 
                title: 'Add Category', 
                url: '/category/create'
              },
              { 
                title: 'List of Categories', 
                url: '/category/list'
              },
            ]
          },
          { 
            title: 'Goods', 
            icon: 'mdi-package-variant-closed',
            sub: [
              { 
                title: 'Add Item', 
                url: '/goods/create'
              },
              { 
                title: 'List of Goods', 
                url: '/goods/list'
              },
            ]
          },
        ],
    }
  }
}
</script>

<style scoped>

a:hover {
  text-decoration: none;
}

.text-warna {
  color: #7b7d80;
}

::v-deep .v-list-group__header__append-icon .v-icon {
  color: #7b7d80;
}
</style>
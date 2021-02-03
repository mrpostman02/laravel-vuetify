<template>
<v-app>
    <v-navigation-drawer
      app
      clipped
    >
      <v-list>
        <v-list-item
            link
            to="/"
            class="text-decoration-none"
        >
            <v-list-item-action>
                <v-icon>mdi-view-dashboard</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <v-list-item-title>Home</v-list-item-title>
            </v-list-item-content>
        </v-list-item>

        <v-list-item
            link
            to="/about"
            class="text-decoration-none"
        >
            <v-list-item-action>
                <v-icon>mdi-view-dashboard</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <v-list-item-title>About</v-list-item-title>
            </v-list-item-content>
        </v-list-item>

        <v-list-item
            link
            to="/contact"
            class="text-decoration-none"
        >
            <v-list-item-action>
                <v-icon>mdi-view-dashboard</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <v-list-item-title>Contact</v-list-item-title>
            </v-list-item-content>
        </v-list-item>

      </v-list>


    </v-navigation-drawer>
    
    <v-app-bar 
      app
      clipped-left
    >
      <v-toolbar-title>App Bar</v-toolbar-title>
    </v-app-bar>
    <v-main>
      <v-container fluid>
        <v-fade-transition mode="out-in">
          <router-view></router-view>
        </v-fade-transition>
      </v-container>
    </v-main>      
  </v-app>
</template>
<script>
export default {
    
}
</script>
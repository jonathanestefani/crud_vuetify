<template>
  <v-list :lines="false" bg-color="transparent" density="compact">
    <v-list-item>
      <strong>
        <h2>Siga a gente</h2>
      </strong>
    </v-list-item>
    <v-list-item>
      <v-row justify="center" align-content="center" no-gutters>
        <span class="bgSocialMedia">
          <router-link to="#" target="_blank">
            <v-icon to="#" icon="mdi-facebook"></v-icon>
          </router-link>
        </span>
        <span class="ml-2 bgSocialMedia">
          <router-link to="#" target="_blank">
            <v-icon to="#" icon="mdi-instagram"></v-icon>
          </router-link>
        </span>
        <span class="ml-2 bgSocialMedia">
          <router-link to="#" target="_blank">
            <v-icon to="#" icon="mdi-twitter"></v-icon>
          </router-link>
        </span>
        <span class="ml-2 bgSocialMedia">
          <router-link to="#" target="_blank">
            <v-icon to="#" icon="mdi-linkedin"></v-icon>
          </router-link>
        </span>
      </v-row>
    </v-list-item>
  </v-list>
</template>

<script lang="ts">
export default {
  name: "ListFollowUs",
};
</script>

<style lang="scss">
.title {
  font-size: 14px;
}
.v-list-item--density-compact {
  min-height: 24px !important;
}
</style>

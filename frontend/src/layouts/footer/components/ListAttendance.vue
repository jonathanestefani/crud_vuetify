<template>
  <v-list bg-color="transparent" density="compact">
    <v-list-item>
      <strong class="d-none d-md-flex">
        <h4>Atendimento ao cliente</h4>
      </strong>
      <strong class="d-flex d-inline-flex justify-center fontCall d-md-none">
        <h4>Fale com a gente</h4>
      </strong>
    </v-list-item>
    <v-list-item>
      <v-row
        class="d-flex d-inline-flex"
        justify="center"
        align-content="center"
        no-gutters
      >
        <span class="d-flex d-inline-flex bgPhone">0800 000 000</span>
        <span class="d-flex d-inline-flex ml-2 bgWhatsapp">
          <router-link to="#" target="_blank">
            <v-icon icon="mdi-whatsapp"></v-icon>
          </router-link>
        </span>
      </v-row>
    </v-list-item>
  </v-list>
</template>

<script lang="ts">
export default {
  name: "ListAttendance",
};
</script>

<style lang="scss">
.fontCall {
  font-size: 15px;
}
.title {
  font-size: 14px;
}
.v-list-item--density-compact {
  min-height: 24px !important;
}
</style>

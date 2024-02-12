<template>
  <v-footer
    color="#565b60"
    padless
    absolute
    inset
    app
    height="200"
    class="py-12"
  >
    <v-container>
      <v-row justify="center" no-gutters>
        <v-col class="d-none d-md-flex text-left text-white" md="2">
          <List :data="listFindvehicle" />
        </v-col>
        <v-col class="d-none d-md-flex text-left text-white" md="2">
          <List :data="listCompany" />
        </v-col>
        <v-col class="d-none d-md-flex text-left text-white" md="2">
          <List :data="listAttendance" />
        </v-col>
        <v-col class="d-none d-md-flex text-left text-white" md="2">
          <List :data="listShopkeepers" />
        </v-col>
        <v-col class="d-none d-md-flex text-center text-white" cols="12" md="2">
          <ListAttendance />
        </v-col>
        <v-col class="d-none d-md-flex text-center text-white" cols="12" md="2">
          <ListFollowUs />
        </v-col>

        <v-col
          class="d-flex d-inline-flex justify-center d-md-none text-center text-white"
          cols="12"
        >
          <ListFollowUs />
        </v-col>
        <v-col
          class="d-flex d-inline-flex justify-center d-md-none text-center text-white"
          cols="12"
        >
          <ListAttendance />
        </v-col>
      </v-row>
    </v-container>
  </v-footer>
</template>

<script lang="ts">
import List from "./components/List.vue";
import ListAttendance from "./components/ListAttendance.vue";
import ListFollowUs from "./components/ListFollowUs.vue";

export default {
  components: {
    List,
    ListAttendance,
    ListFollowUs,
  },
  data() {
    return {
      listFindvehicle: [
        { name: "Encontre seu veículo", url: "#!" },
        { name: "Encontre seu veículo", url: "#!" },
        { name: "Lojas", url: "#!" },
        { name: "Promoções", url: "#!" },
        { name: "Vantagens", url: "#!" },
        { name: "Garantia Mais", url: "#!" },
      ],
      listCompany: [
        { name: "A Empresa", url: "#!" },
        { name: "Sobre", url: "#!" },
        { name: "Delivery", url: "#!" },
        { name: "Aviso de Privacidade", url: "#!" },
        { name: "Blog Seminovos", url: "#!" },
      ],
      listAttendance: [
        { name: "Atendimento", url: "#!" },
        { name: "Perguntas frequentes", url: "#!" },
        { name: "Fale Conosco", url: "#!" },
        { name: "Pós-vendas", url: "#!" },
      ],
      listShopkeepers: [
        { name: "Lojistas", url: "#!" },
        { name: "Acesse Seminovos Atacado", url: "#!" },
      ],
    };
  },
};
</script>

<style lang="scss">
.bgPhone {
  background: rgb(103, 58, 183);
  padding: 5px 7px;
  display: block;
  border-radius: 3px;
  width: fit-content;
}
.bgWhatsapp {
  background: #4ac959;
  padding: 5px;
  display: block;
  border-radius: 3px;
  width: fit-content;
}
.bgWhatsapp * {
  color: white;
}
.bgSocialMedia {
  background: rgb(103, 58, 183);
  padding: 5px;
  display: block;
  border-radius: 3px;
  width: fit-content;
  font-size: 11px;
  color: white;
}
.bgSocialMedia * {
  color: white;
}
.v-list-item--variant-text .v-list-item__overlay {
  background: transparent !important;
}
</style>

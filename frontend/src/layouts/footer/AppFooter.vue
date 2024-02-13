<template>
  <v-footer
    color="#fff"
    padless
    absolute
    inset
    app
    height="200"
    class="py-12"
  >
    <v-container>
      <v-row justify="center" no-gutters>
        <v-col class="d-none d-block text-center text-black " md="4">
          <img src="https://d1zmtoblzb5ysp.cloudfront.net/00244e50-a5e4-4d51-9497-5fd3c55982db/images/eloca_logo_pequena.webp" class="img-fluid" alt="Eloca" width="180" height="39">
          <p>A Eloca é líder absoluta em sistemas, plataformas e soluções para locadoras de diversos portes e segmentos do Brasil.</p>
        </v-col>

        <v-col class="d-flex justify-end text-black" cols="12" md="12">
          <ListFollowUs />
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

<template>
  <v-container>
    <v-card>
      <v-card-title>
        <v-toolbar>
              <v-toolbar-title>Lista de Empresas</v-toolbar-title>
              <v-spacer></v-spacer>
              <v-btn color="primary" depressed class="mb-2" @click="record()">
                Cadastrar
              </v-btn>
            </v-toolbar>

      </v-card-title>
      <v-card-text>
        <v-data-table :headers="headers" :items="items" item-key="recnum" :loading="loading" loading-text="Carregando"
          hide-default-footer>
          <template v-slot:top>
            
          </template>
          <template v-slot:item.codigo="{ item }">
            {{ item.codigo }}
          </template>
          <template v-slot:item.empresa="{ item }">
            {{ item.empresa }}
          </template>
          <template v-slot:item.sigla="{ item }">
            {{ item.sigla }}
          </template>
          <template v-slot:item.razao_social="{ item }">
            {{ item.razao_social }}
          </template>
          <template v-slot:item.opcao_excluir="{ item }">
            <v-btn
              icon
              flat
              v-on="on"><v-icon small>mdi-delete</v-icon>
            </v-btn>
          </template>
        </v-data-table>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script lang="ts" src="./list.ts"></script>

<template>
  <v-container>
    <v-card>
      <v-card-title>
        <v-toolbar>
          <v-toolbar-title>Lista de Clientes</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn color="primary" depressed class="mb-2" @click="record()">
            Cadastrar
          </v-btn>
        </v-toolbar>

      </v-card-title>
      <v-card-text>
        <v-data-table
          :headers="headers"
          :items="items"
          item-key="recnum"
          :loading="loading"
          loading-text="Carregando">
          <template v-slot:item.recnum="{ item }">
            {{ item.recnum }}
          </template>
          <template v-slot:item.empresa="{ item }">
            {{ item.empresa }}
          </template>
          <template v-slot:item.codigo="{ item }">
            {{ item.codigo }}
          </template>
          <template v-slot:item.razao_social="{ item }">
            {{ item.razao_social }}
          </template>
          <template v-slot:item.tipo="{ item }">
            {{ item.tipo }}
          </template>
          <template v-slot:item.cpf_cnpj="{ item }">
            {{ item.cpf_cnpj }}
          </template>
          <template v-slot:item.opcao="{ item }">
            <v-btn
              icon
              flat
              v-on="on"
              @click="edit(item)"><v-icon small>mdi-pencil</v-icon>
            </v-btn>
            <v-btn
              icon
              flat
              v-on="on"
              @click="destroy(item)"><v-icon small>mdi-delete</v-icon>
            </v-btn>
          </template>
          <template #bottom></template>
        </v-data-table>
        <pagination
          :paginationObject="paginationObject"
          @change="load"
          :loading="loading"
        />
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script lang="ts" src="./list.ts"></script>
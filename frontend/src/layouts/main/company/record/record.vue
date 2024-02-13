<template>
  <v-container>
    <v-card>
      <v-card-title>{{ mode === 'edit' ? 'Editar Empresa' : 'Cadastrar Nova Empresa' }}</v-card-title>
      <v-card-text>
        <v-form ref="form" v-model="valid" :loading="loading">
          <v-container>
            <v-row>
              <v-col
                cols="12"
                sm="6"
              >
              <v-text-field
                outlined
                v-model="company.codigo"
                label="Código"
                disabled></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="6"
              >
              <v-text-field
                outlined
                v-model="company.empresa"
                label="Empresa"
                :rules="rules"></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="6"
              >
              <v-text-field
                outlined
                v-model="company.sigla"
                label="Sigla"
                :rules="rules"></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="6"
              >
              <v-text-field
                outlined
                v-model="company.razao_social"
                label="Razão Social"
                :rules="rules"></v-text-field>
              </v-col>
            </v-row>
          </v-container>
        </v-form>        
      </v-card-text>
      <v-card-actions class="justify-end">
        <v-btn :loading="loading" color="error" @click="cancel()">Cancelar</v-btn>
        <v-btn :loading="loading" color="primary" @click="record()">{{ mode === 'edit' ? 'Salvar' : 'Cadastrar' }}</v-btn>
      </v-card-actions>
    </v-card>
  </v-container>
</template>

<script lang="ts" src="./record.ts"></script>

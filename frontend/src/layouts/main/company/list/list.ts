export default {
  data() {
    return {
      loading: false,
      headers: [
        { title: 'Recnum', value: 'recnum' },
        { title: 'Código', value: 'codigo' },
        { title: 'Empresa', value: 'empresa' },
        { title: 'Sigla', value: 'sigla' },
        { title: 'Razão Social', value: 'razao_social' },
        { title: '', value: 'opcao_excluir' },
      ],
      items: [
        { recnum: 1, codigo: '001', empresa: 'Empresa 1', sigla: 'E1', razao_social: 'Empresa 1 LTDA', opcao_excluir: '' },
        { recnum: 2, codigo: '002', empresa: 'Empresa 2', sigla: 'E2', razao_social: 'Empresa 2 LTDA', opcao_excluir: '' },
        { recnum: 3, codigo: '003', empresa: 'Empresa 3', sigla: 'E3', razao_social: 'Empresa 3 LTDA', opcao_excluir: '' },
        // Adicione mais empresas conforme necessário
      ],
    };
  },
  methods: {
    record() {
      this.$router.push('/company/record');
    },
    load() {
      this.loading = true;


      this.loading = false;
    }
  }
};
export default {
  data() {
    return {
      loading: false,
      headers: [
        { title: 'Recnum', value: 'recnum' },
        { title: 'Empresa', value: 'empresa' },
        { title: 'Código', value: 'codigo' },
        { title: 'Razão Social', value: 'razao_social' },
        { title: 'Tipo', value: 'tipo' },
        { title: 'CPF/CNPJ', value: 'cpf_cnpj' },
        { title: '', value: 'opcao_excluir' },
      ],
      items: [
        { recnum: 1, empresa: 'Empresa 1', codigo: '001', razao_social: 'Empresa 1 LTDA', tipo: 'E1', cpf_cnpj: '0001110101121', opcao_excluir: '' },
        { recnum: 2, empresa: 'Empresa 2', codigo: '002', razao_social: 'Empresa 2 LTDA', tipo: 'E2', cpf_cnpj: '0001110101121', opcao_excluir: '' },
        { recnum: 3, empresa: 'Empresa 3', codigo: '003', razao_social: 'Empresa 3 LTDA', tipo: 'E3', cpf_cnpj: '0001110101121', opcao_excluir: '' },
        // Adicione mais empresas conforme necessário
      ],
    };
  },
  methods: {
    record() {
      this.$router.push('/customer/record');
    },
    load() {
      this.loading = true;


      this.loading = false;
    }
  }
};
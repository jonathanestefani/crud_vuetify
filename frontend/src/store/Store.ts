import { createStore } from "vuex";

export const store = createStore({
  state: {
    home: {
      carFilter: "",
      addCarEntry: 0,
      entryValue: 0,
      car: {},
    },
  },
  getters: {
    getCar: (state) => state.home.car,
  },
  mutations: {
    // we can use the ES2015 computed property name feature
    // to use a constant as the function name
    home_addCarFilter(state, value) {
      state.home.carFilter = value;
    },
    home_addCarEntryValue(state, value) {
      state.home.entryValue = value;
    },
    home_addCar(state, value) {
      state.home.car = value;
    },
  },
});

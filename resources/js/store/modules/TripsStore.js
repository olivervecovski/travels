import User from "../../Helpers/User";
import Trips from "../../Helpers/Trips";
import { routes } from '../../routes.js';

const tripsstore = {
  state: {
    count: 0,
    trips: {},
  },
  mutations: {
    set_trips(state, trips) {
      state.trips = trips;
    },
  },
  actions: {
    async getTrips({commit}){
      return await Trips.index()
      .then(response => {
        commit('set_trips', response.data)
      })
    },
  },
  modules: {},
  getters: {
    trips: state => state.trips
  }
};

export default tripsstore
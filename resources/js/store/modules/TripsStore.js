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

    async create_trip({commit},form) {
      return await Trips.create(form)
      .then(response => {
        console.log(response.data);
        return {'message': 'Trip saved', 'success': true};
      })
      .catch(err => {
        console.log(err.response.data)
        return {'message': err.response.data.message, 'success': false};
      })
    }
  },
  modules: {},
  getters: {
    trips: state => state.trips
  }
};

export default tripsstore
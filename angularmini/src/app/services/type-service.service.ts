import { Injectable } from '@angular/core';
import axios from 'axios';

@Injectable({
  providedIn: 'root',
})
export class TypeServiceService {
  constructor() {}

  getAllTypes() {
    axios.get('http://laravelmini.loc/api/types').then((response) => {
      console.log(response.data);
    });
  }
  createType() {
    axios
      .post('http://laravelmini.loc/api/types', { name: 'Lenovo' })
      .then((response) => {
        console.log(response.data);
      });
  }
}

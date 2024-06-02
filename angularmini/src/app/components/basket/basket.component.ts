import { Component, OnInit } from '@angular/core';
import axios from 'axios';
import { Router } from '@angular/router';

import { CommonModule } from '@angular/common';
@Component({
  selector: 'app-basket',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './basket.component.html',
  styleUrl: './basket.component.scss',
})
export class BasketComponent implements OnInit {
  basketId!: any;
  basketDevices!: any;
  idOfDevicesInBasket!: any;
  devices!: any;
  totalCost!: any;
  constructor(private router: Router) {}
  async ngOnInit() {
    await this.getBasket();
    await this.getBasketDevice();
    await this.getManyDevices();
    this.totalCost = this.devices.reduce(
      (sum: any, device: any) => sum + device.price,
      0
    );
    for (const device of this.devices) {
      await this.getImg(device);
    }
  }

  async getImg(device: any) {
    try {
      const imgName = device.img;
      const response = await axios.get(
        `http://laravelmini.loc/storage/${imgName}`,
        { responseType: 'blob' }
      );
      const reader = new FileReader();
      reader.onloadend = () => {
        device.imgSrc = reader.result;
      };
      reader.readAsDataURL(response.data);
    } catch (error) {
      console.error('Error loading image:', error);
    }
  }

  async getBasket() {
    const basket = await axios.get(
      `http://laravelmini.loc/api/baskets/${localStorage.getItem('userId')}`
    );
    this.basketId = basket.data[0];
  }
  async getBasketDevice() {
    const basketDevices = await axios.get(
      `http://laravelmini.loc/api/basket_devices/${this.basketId.id}`
    );

    this.basketDevices = basketDevices.data;
    const idOfDevicesInBasket = this.basketDevices.map(
      (device: any) => device.device_id
    );
    this.idOfDevicesInBasket = idOfDevicesInBasket;
  }
  async getManyDevices() {
    const devices = await axios.get(
      `http://laravelmini.loc/api/get_many/${this.idOfDevicesInBasket}`
    );
    this.devices = devices.data;
  }
  async deleteFromBasket(deviceId: any) {
    const data = {
      basketId: this.basketId,
      basketDeviceId: deviceId,
    };
    await axios.delete(`http://laravelmini.loc/api/basket_devices`, { data });
    this.fetchBasketData();
  }
  async fetchBasketData() {
    try {
      const response = await axios.get(
        `http://laravelmini.loc/api/basket_devices/${this.basketId.id}`
      );
      this.basketDevices = response.data;
    } catch (error) {
      console.error('Error fetching basket data:', error);
    }
  }
  async onBuy() {
    for (const basketDevice of this.basketDevices) {
      await this.deleteFromBasket(basketDevice.device_id);
    }
    this.router.navigate(['/']);
  }
}

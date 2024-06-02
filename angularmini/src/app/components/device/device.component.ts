import { Component, OnInit } from '@angular/core';
import axios from 'axios';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-device',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './device.component.html',
  styleUrl: './device.component.scss',
})
export class DeviceComponent implements OnInit {
  currentUrl: string = '';
  deviceId!: number;
  device!: any;
  deviceInfo!: any;
  brand!: any;
  basketData!: any;

  imgSrc: string | ArrayBuffer | null = null;
  constructor() {
    this.currentUrl = window.location.href;
    this.deviceId = parseInt(this.currentUrl.split('/').pop() || '', 10);
  }
  async ngOnInit() {
    await this.getDevice();

    await this.getImg();
  }

  async getDevice() {
    try {
      const device = await axios.get(
        `http://laravelmini.loc/api/devices/${this.deviceId}`
      );
      this.device = device.data.device;
      this.deviceInfo = device.data.deviceInfo;

      const brand = await axios.get(
        `http://laravelmini.loc/api/brands/${this.device.brand_id}`
      );
      this.brand = brand.data;
    } catch (error) {}
  }

  async getImg() {
    try {
      const imgName = this.device.img;
      const response = await axios.get(
        `http://laravelmini.loc/storage/${imgName}`,
        { responseType: 'blob' }
      );
      const reader = new FileReader();
      reader.onloadend = () => {
        this.imgSrc = reader.result;
      };
      reader.readAsDataURL(response.data);
    } catch (error) {
      console.error('Error loading image:', error);
    }
  }
  async addToBasket() {
    try {
      const basketData = await axios.get(
        `http://laravelmini.loc/api/baskets/${localStorage.getItem('userId')}}`
      );
      this.basketData = basketData.data[0];
      const basketDevices = await axios.post(
        `http://laravelmini.loc/api/basket_devices`,
        {
          basketId: this.basketData.id,
          deviceId: this.device.id,
        }
      );
      alert('Device added to basket!');
    } catch (error) {
      console.log(error);
    }
  }
}

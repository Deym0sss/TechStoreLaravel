import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Router } from '@angular/router';
import { ActivatedRoute } from '@angular/router';
import axios from 'axios';

@Component({
  selector: 'app-shop',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './shop.component.html',
  styleUrl: './shop.component.scss',
})
export class ShopComponent implements OnInit {
  brandId: number | null = null;
  typeId: number | null = null;
  devices: any = [];
  types: any = [];
  brands: any = [];
  imgSrc: string | ArrayBuffer | null = null;
  constructor(private router: Router) {}
  async ngOnInit() {
    await this.fetchData();
  }

  async fetchData() {
    try {
      const devicesResponse = await axios.get(
        'http://laravelmini.loc/api/devices',
        {
          params: {
            limit: 10,
            page: 1,
            brandId: this.brandId,
            typeId: this.typeId,
          },
        }
      );
      this.devices = devicesResponse.data.devices;

      const typesResponse = await axios.get('http://laravelmini.loc/api/types');
      this.types = typesResponse.data;

      const brandsResponse = await axios.get(
        'http://laravelmini.loc/api/brands'
      );
      this.brands = brandsResponse.data;

      for (const device of this.devices) {
        await this.getImg(device);
      }
    } catch (error) {
      console.error('Error fetching data:', error);
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

  async brandSelect(brandId: number) {
    this.brandId = brandId;
    await this.fetchData();
  }

  async typeSelect(typeId: number) {
    this.typeId = typeId;
    await this.fetchData();
  }

  async clearType() {
    this.typeId = null;
    await this.fetchData();
  }
  async clearBrand() {
    this.brandId = null;
    await this.fetchData();
  }
  async clearAll() {
    this.typeId = null;
    this.brandId = null;
    await this.fetchData();
  }

  clickOnDevice(deviceId: number) {
    this.router.navigate([`/device/${deviceId}`]);
  }
}

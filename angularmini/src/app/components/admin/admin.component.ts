import { Component, TemplateRef, ViewChild } from '@angular/core';
import { ModalComponent } from '../../modal-component/modal-component.component';
import { TypeServiceService } from '../../services/type-service.service';
import {
  FormsModule,
  ReactiveFormsModule,
  FormBuilder,
  FormGroup,
  FormArray,
  Validators,
} from '@angular/forms';
import { CommonModule } from '@angular/common';
import axios from 'axios';

@Component({
  standalone: true,
  imports: [ModalComponent, FormsModule, ReactiveFormsModule, CommonModule],
  selector: 'app-admin',
  templateUrl: './admin.component.html',
  styleUrls: ['./admin.component.scss'],
})
export class AdminComponent {
  types: any[] = [];
  @ViewChild('createTypeTemplate', { static: true })
  createTypeTemplate!: TemplateRef<any>;
  @ViewChild('createBrandTemplate', { static: true })
  createBrandTemplate!: TemplateRef<any>;
  @ViewChild('createDeviceTemplate', { static: true })
  createDeviceTemplate!: TemplateRef<any>;
  @ViewChild('deleteTypeTemplate', { static: true })
  deleteTypeTemplate!: TemplateRef<any>;
  @ViewChild('deleteBrandTemplate', { static: true })
  deleteBrandTemplate!: TemplateRef<any>;
  @ViewChild('deleteDeviceTemplate', { static: true })
  deleteDeviceTemplate!: TemplateRef<any>;

  formDataTypeCreate: any = {};
  formDataBrandCreate: any = {};
  formDataDeviceCreate: any = {};
  formDataTypeDelete: any = {};
  formDataBrandDelete: any = {};
  formDataDeviceDelete: any = {};
  file!: File;

  infoForm: FormGroup;

  constructor(
    private typeService: TypeServiceService,
    private fb: FormBuilder
  ) {
    this.infoForm = this.fb.group({
      info: this.fb.array([]),
    });
  }

  get info(): FormArray {
    return this.infoForm.get('info') as FormArray;
  }

  addInfo() {
    console.log('Adding new info group');
    this.info.push(
      this.fb.group({
        title: ['', Validators.required],
        description: ['', Validators.required],
      })
    );
  }

  removeInfo(index: number) {
    this.info.removeAt(index);
  }
  changeInfo(index: number, key: string, event: Event) {
    const inputElement = event.target as HTMLInputElement;
    const infoGroup = this.info.at(index) as FormGroup;
    if (infoGroup && inputElement) {
      infoGroup.patchValue({ [key]: inputElement.value });
    }
  }

  onFileSelected(event: any) {
    if (event.target.files && event.target.files.length > 0) {
      this.file = event.target.files[0];
    }
  }

  async onSubmitDeviceCreate() {
    if (!this.file) {
      console.error('No file selected!');
      return;
    }
    try {
      const base64 = await this.fileToBase64(this.file);
      const data = {
        name: this.formDataDeviceCreate.name,
        price: Number(this.formDataDeviceCreate.price),
        img: base64,
        type_id: this.formDataDeviceCreate.typeId,
        brand_id: this.formDataDeviceCreate.brandId,
        info: JSON.stringify(this.info.value),
      };
      await axios.post('http://laravelmini.loc/api/devices', data);
    } catch (error) {
      console.error('Error uploading file', error);
    }
  }

  fileToBase64(file: File): Promise<string> {
    return new Promise((resolve, reject) => {
      const reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = () => resolve(reader.result as string);
      reader.onerror = (error) => reject(error);
    });
  }

  async onSubmitTypeCreate() {
    await axios.post(
      'http://laravelmini.loc/api/types',
      this.formDataTypeCreate
    );
  }

  async onSubmitBrandCreate() {
    await axios.post(
      'http://laravelmini.loc/api/brands',
      this.formDataBrandCreate
    );
  }

  async onSubmitTypeDelete() {
    await axios.delete(
      `http://laravelmini.loc/api/types/${this.formDataTypeDelete.id}`
    );
  }

  async onSubmitBrandDelete() {
    await axios.delete(
      `http://laravelmini.loc/api/brands/${this.formDataBrandDelete.id}`
    );
  }

  async onSubmitDeviceDelete() {
    await axios.delete(
      `http://laravelmini.loc/api/devices/${this.formDataDeviceDelete.id}`
    );
  }

  loadTypes(): void {
    this.typeService.getAllTypes();
  }

  createType(): void {
    this.typeService.createType();
  }
}

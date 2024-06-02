import { Routes } from '@angular/router';
import { ShopComponent } from './components/shop/shop.component';
import { AdminComponent } from './components/admin/admin.component';
import { AuthComponent } from './components/auth/auth.component';
import { BasketComponent } from './components/basket/basket.component';
import { DeviceComponent } from './components/device/device.component';
import { RegistrationComponent } from './components/registration/registration.component';
export const routes: Routes = [
  {
    path: '',
    component: ShopComponent,
  },
  {
    path: 'admin',
    component: AdminComponent,
  },
  {
    path: 'auth',
    component: AuthComponent,
  },
  {
    path: 'registration',
    component: RegistrationComponent,
  },
  {
    path: 'basket',
    component: BasketComponent,
  },
  {
    path: 'device/:id',
    component: DeviceComponent,
  },
];

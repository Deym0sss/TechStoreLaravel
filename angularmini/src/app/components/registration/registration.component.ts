import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { RouterModule } from '@angular/router';
import { FormsModule } from '@angular/forms';
import axios from 'axios';

@Component({
  standalone: true,
  selector: 'app-registration',
  templateUrl: './registration.component.html',
  styleUrls: ['./registration.component.scss'],
  imports: [FormsModule, RouterModule],
})
export class RegistrationComponent {
  formData: any = { role: 'ADMIN' };

  constructor(private router: Router) {}

  onEmailChange(email: string): void {
    this.formData.email = email;
    console.log(email);
  }

  onPasswordChange(password: string): void {
    this.formData.password = password;
    console.log(password);
  }

  async onSubmitCreate() {
    try {
      const response = await axios.post(
        'http://laravelmini.loc/api/users',
        this.formData
      );
      localStorage.setItem('userId', response.data.id);
      localStorage.setItem('email', this.formData.email);
      localStorage.setItem('isLogin', 'true');

      this.router.navigate(['/']);
    } catch (error) {
      alert('User with this email already exist');
    }
  }
}

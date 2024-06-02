import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { RouterModule } from '@angular/router';
import { FormsModule } from '@angular/forms';
import axios from 'axios';

@Component({
  standalone: true,
  selector: 'app-auth',
  templateUrl: './auth.component.html',
  styleUrls: ['./auth.component.scss'],
  imports: [FormsModule, RouterModule],
})
export class AuthComponent {
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

  $users: any = [];
  async onLogin() {
    try {
      await axios.get('http://laravelmini.loc/api/users').then((res) => {
        this.$users = res.data;
      });

      const isCorrectCreds = this.$users.some(
        (user: { email: string; password: string }) => {
          return (
            user.email === this.formData.email &&
            user.password === this.formData.password
          );
        }
      );
      if (!isCorrectCreds) {
        return alert('Wrong email or password');
      }
      localStorage.setItem('email', this.formData.email);
      localStorage.setItem('isLogin', 'true');
      const email = localStorage.getItem('email');
      const user = this.$users.find(
        (user: { email: string }) => user.email === email
      );
      localStorage.setItem('userId', user.id);
      this.router.navigate(['/']);
    } catch (error) {
      console.log(error);
    }
  }
}

import { Component } from '@angular/core';
import { RouterModule } from '@angular/router';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
@Component({
  selector: 'app-header',
  standalone: true,
  imports: [NgbModule, RouterModule],
  templateUrl: './header.component.html',
  styleUrl: './header.component.scss',
})
export class HeaderComponent {
  resetLocalStorage() {
    localStorage.removeItem('userId');
    localStorage.removeItem('email');
    localStorage.removeItem('isLogin');
  }
}

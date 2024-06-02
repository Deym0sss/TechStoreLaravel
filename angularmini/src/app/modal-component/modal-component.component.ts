import { Component, Input, TemplateRef } from '@angular/core';
import { CommonModule } from '@angular/common';
@Component({
  standalone: true,
  selector: 'app-modal',
  templateUrl: './modal-component.component.html',
  styleUrls: ['./modal-component.component.scss'],
  imports: [CommonModule],
})
export class ModalComponent {
  @Input() modalId!: string;
  @Input() title!: string;
  @Input() contentTemplate!: TemplateRef<any>;
}

import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrl: './header.component.scss'
})
export class HeaderComponent implements OnInit {
  nombre:string=localStorage.getItem('rol')+': '+localStorage.getItem('user');
  ngOnInit(): void {
  }

}

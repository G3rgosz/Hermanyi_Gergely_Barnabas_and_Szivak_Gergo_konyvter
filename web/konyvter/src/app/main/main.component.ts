import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { AuthService } from '../shared/auth.service';

@Component({
  selector: 'app-main',
  templateUrl: './main.component.html',
  styleUrls: ['./main.component.css']
})
export class MainComponent implements OnInit {
  ads:any;
  books:any = [];

  host = 'http://localhost:8000/api/';
  server = 'http://localhost:8000';

  constructor(
    private router: Router,
    private http: HttpClient,
    private auth: AuthService
  ) { }

  ngOnInit(): void {
    this.getMyAds();
  }
  getMyAds(){
    let endpoint = 'web/advertisements';
    let url = this.host + endpoint;
    
    this.http.get<any>(url)
    .subscribe(
      (res) => {
        this.ads = res.data;
        for(let ad of res.data){
          this.getBook(ad.book_id);
        }
      }, (error) => {
        console.error(error);
    });
  }
  getBook(book_id:any){
    let endpoint = 'web/books/';
    let url = this.host + endpoint + book_id;
    this.http.get<any>(url)
    .subscribe(
      (res) => {
        this.books.push(res.data[0]);
      }, (error) => {
        console.error(error);
    });
  }
  getBookTitle(book_id:any){
    let title;
    let writer;
    for(let book of this.books){
      if(book.id == book_id){
        writer = book.writer;
        title = book.title;
      }
    }
    return writer+": "+title;
  }
  navigateAd(id:any){
    this.router.navigate(['advertisement/', id]);
  }
}

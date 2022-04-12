import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { AuthService } from '../shared/auth.service';
import { FormControl, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-main',
  templateUrl: './main.component.html',
  styleUrls: ['./main.component.css']
})
export class MainComponent implements OnInit {
  
  ads:any;
  books:any = [];
  filterForm!:FormGroup;
  genres:any;

  filter:boolean = false;

  host = 'http://localhost:8000/api/';
  server = 'http://localhost:8000';

  page = 1;

  constructor(
    private router: Router,
    private http: HttpClient,
    private auth: AuthService
  ) { }

  ngOnInit(): void {
    this.getGenres();
    this.getAds();
    this.filterForm = new FormGroup({
      adtitle: new FormControl(''),
      title: new FormControl(''),
      writer: new FormControl(''),
      max_price: new FormControl('', [Validators.maxLength(10), Validators.pattern("[0-9]*$")]),
      genres: new FormControl('')
    })
  }
  changePage(event:any){
    this.page = event
  }
  getAds(){
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
  getGenres(){
    let endpoint = 'web/genres';
    let url = this.host + endpoint;
    this.http.get<any>(url)
    .subscribe(
      (res) => {
        this.genres = res.data;
      }, (error) => {
        console.error(error);
    });
  }
  filterShow(){
    if(this.filter == false){
      this.filter = true;
    }else{
      this.filterForm.reset();
      this.filter = false;
    }
  }
  navigateAd(id:any){
    this.router.navigate(['advertisement/', id]);
  }
  search(){
    let adtitle:any = this.filterForm.value.adtitle;
    let title:any = this.filterForm.value.title;
    let writer:any = this.filterForm.value.writer;
    let max_price:any = this.filterForm.value.max_price;
    let genres:any = [this.filterForm.value.genres];

    let searchData = {
      adtitle: adtitle,
      title: title,
      writer: writer,
      max_price: max_price,
      genres: genres
    };

    console.log(searchData);
    if(adtitle == '' || adtitle == null){
      delete searchData['adtitle'];
    }if(title == '' || title == null){
      delete searchData['title'];
    }if(writer == '' || writer == null){
      delete searchData['writer'];
    }if(max_price == '' || max_price == null){
      delete searchData['max_price'];
    }if(genres == '' || genres == null){
      delete searchData["genres"];
    }

    let endpoint = 'web/advertisements/filter';
    let url = this.host + endpoint;

    let data = JSON.stringify(searchData);

    let headerObj = new HttpHeaders({
      'Content-Type':'application/json'
    })
    let header = {
      headers: headerObj
    }

    this.http.post<any>(url,data, header)
    .subscribe(
      (res) => {
        let ads:any = [];
        for(let ad of res.data){   
          this.getBook(ad[0].book_id);
          ads.push(ad[0]);
        }
        this.ads = ads;
      }, (error) => {
        console.error(error);
        alert('Nincs találat a keresésre!');
    });
  }
}

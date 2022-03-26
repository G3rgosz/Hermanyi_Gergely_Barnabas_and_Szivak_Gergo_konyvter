import { ComponentFixture, TestBed } from '@angular/core/testing';

import { NewadvertisementComponent } from './newadvertisement.component';

describe('NewadvertisementComponent', () => {
  let component: NewadvertisementComponent;
  let fixture: ComponentFixture<NewadvertisementComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ NewadvertisementComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(NewadvertisementComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

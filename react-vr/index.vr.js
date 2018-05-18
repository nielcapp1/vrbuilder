import React from 'react';
import { 
  NativeModules, 
  AppRegistry, 
  Sound, 
  VideoPano, 
  asset, 
  Location, 
  Pano, 
  Text, 
  Animated, 
  View, 
  VrButton, 
  Image, 
  StyleSheet, 
  CylindricalPanel, 
  Model} from 'react-vr';
import Button from './components/button.js';
import axios from 'axios';
import TimerMixin from 'react-timer-mixin';

const Linking = NativeModules.LinkingManager

class react_vr extends React.Component {

  constructor() {
    super();
    this.state = { 
      baseUrl: 'http://www.vrbuilder.be/',
      space: [],
      pano: [],
      sounds: [],
      videopano: [],
      items: [],
      slide01: '',
      slide02: '',
      slide03: '',
      slide04: '',
      slide05: '',
      slide06: '',
      currentItem: 1,
      bounceValue: new Animated.Value(1),
      disableButtonPrevious: false,
      disableButtonNext: false,
      colorButton: '#263238'
    };
    this.styles = StyleSheet.create({
      menu: {
        position: 'absolute',
        flex: 1,
        flexDirection: 'row',
        width: 1,
        alignItems: 'stretch',
        transform: [
          {translate: [-1.20, 1.6, -5]}
        ], 
      },
      text: { 
        fontSize: 0.15,
        textAlign: 'center',
        fontWeight: '500',
        color: '#FFF'
      }, 
      description: {
        fontSize: 0.30,
        textAlign: 'center',
        fontWeight: '500',
        color: '#FFF',
        paddingTop: 0.15,
        paddingBottom: 0.15,
        textAlignVertical: 'center',
        transform: [
          {translate: [-2.5 , 2.5, -10]}, 
        ],
      },
      button: { 
        borderRadius: .1,
        paddingTop: 0.05,
        paddingBottom: 0.05,
        width: 1.1,
        marginLeft: 0.05,
        marginRight: 0.05,
        backgroundColor: this.state.colorButton,
      },
      image: {
        width: 5,
        height: 5,
        overflow: 'hidden',
        transform: [
          {translate: [-2.5, 2.5, -10]}, 
          {scale: this.state.bounceValue},
          {rotateY: 0}, 
          {rotateX: 0},
          {rotateZ: 0} 
        ], 
      },
      image01: {
        borderRadius: 2.3,
        width: 4.6,
        height: 4.6,
        overflow: 'hidden',
        transform: [
          {translate: [-2.3, 2.3, -10]}, 
          {scale: this.state.bounceValue},
          {rotateY: 0}, 
          {rotateX: 0},
          {rotateZ: 0} 
        ], 
      },
      titleSlide01: {
        width: 3.8,
        fontSize: 0.30,
        textAlign: 'center',
        fontWeight: '500',
        backgroundColor: '#FFF',
        color: '#000',
        borderRadius: .50,
        paddingTop: 0.30,
        paddingBottom: 0.30,
        textAlignVertical: 'center',
        transform: [
          {translate: [-1.9, 2.3, -8]},
        ],
      },
      image02: {
        borderRadius: 4.6,
        width: 9.2,
        height: 9.2,
        overflow: 'hidden',
        transform: [
          {translate: [12.5, 10.2, -10]}, 
          {scale: this.state.bounceValue},
          {rotateY: -60}, 
          {rotateX: 0},
          {rotateZ: 0} 
        ], 
      },
      titleSlide02: {
        width: 9.2,
        fontSize: 0.70,
        textAlign: 'center',
        fontWeight: '500',
        backgroundColor: '#FFF',
        color: '#000',
        borderRadius: 1.40,
        paddingTop: .7,
        paddingBottom: .7,
        textAlignVertical: 'center',
        transform: [
          {translate: [12.5, 9.2, -10]}, 
          {rotateY: -60},
        ],
      },
      image03: {
        borderRadius: 16.5,
        width: 33,
        height: 33,
        overflow: 'hidden',
        transform: [
          {translate: [45, 33.5, 35]}, 
          {scale: this.state.bounceValue},
          {rotateY: -120}, 
          {rotateX: 0},
          {rotateZ: 0} 
        ], 
      },
      titleSlide03: {
        width: 33,
        fontSize: 2.5,
        textAlign: 'center',
        fontWeight: '500',
        backgroundColor: '#FFF',
        color: '#000',
        borderRadius: 5,
        paddingTop: 2.5,
        paddingBottom: 2.5,
        textAlignVertical: 'center',
        transform: [
          {translate: [45, 30, 35]}, 
          {rotateY: -120},
        ],
      },
      image04: {
        borderRadius: 70,
        width: 136,
        height: 136,
        overflow: 'hidden',
        transform: [
          {translate: [-70, 125, 285]}, 
          {scale: this.state.bounceValue},
          {rotateY: -180}, 
          {rotateX: 0},
          {rotateZ: 0} 
        ], 
      },
      titleSlide04: {
        width: 136,
        fontSize: 10,
        textAlign: 'center',
        fontWeight: '500',
        backgroundColor: '#FFF',
        color: '#000',
        borderRadius: 16,
        paddingTop: 8,
        paddingBottom: 8,
        textAlignVertical: 'center',
        transform: [
          {translate: [-70, 112, 285]},
          {rotateY: -180},
        ],
      },
      image05: {
        borderRadius: 120,
        width: 235,
        height: 235,
        overflow: 'hidden',
        transform: [
          {translate: [-560, 340, 250]}, 
          {scale: this.state.bounceValue},
          {rotateY: -240}, 
          {rotateX: 0},
          {rotateZ: 0} 
        ], 
      },
      titleSlide05: {
        width: 235,
        fontSize: 20,
        textAlign: 'center',
        fontWeight: '500',
        backgroundColor: '#FFF',
        color: '#000',
        borderRadius: 30,
        paddingTop: 15,
        paddingBottom: 15,
        textAlignVertical: 'center',
        transform: [
          {translate: [-560, 310, 250]}, 
          {rotateY: -240},
        ],
      },
      image06: {
        borderRadius: 120,
        width: 235,
        height: 235,
        overflow: 'hidden',
        transform: [
          {translate: [-550, 630, -250]}, 
          {scale: this.state.bounceValue},
          {rotateY: -300}, 
          {rotateX: 0},
          {rotateZ: 0} 
        ], 
      },
      titleSlide06: {
        width: 235,
        fontSize: 20,
        textAlign: 'center',
        fontWeight: '500',
        backgroundColor: '#FFF',
        color: '#000',
        borderRadius: 30,
        paddingTop: 15,
        paddingBottom: 15,
        textAlignVertical: 'center',
        transform: [
          {translate: [-550, 605, -250]}, 
          {rotateY: -300},
        ],
      },
      imageFrame01: {
        width: 4.6,
        height: 4.6,
        overflow: 'hidden',
        transform: [
          {translate: [-2.3, 2.3, -10]}, 
          {scale: this.state.bounceValue},
          {rotateY: 0}, 
          {rotateX: 0},
          {rotateZ: 0} 
        ], 
      },
      titleImageFrame01: {
        width: 3.8,
        fontSize: 0.20,
        textAlign: 'center',
        fontWeight: '500',
        backgroundColor: '#634E42',
        color: '#FFF',
        paddingTop: 0.10,
        paddingBottom: 0.10,
        textAlignVertical: 'center',
        transform: [
          {translate: [-1.9, 2.45, -8]},
        ],
      },
      imageFrame02: {
        width: 9.2,
        height: 9.2,
        overflow: 'hidden',
        transform: [
          {translate: [13, 9.6, -10]}, 
          {scale: this.state.bounceValue},
          {rotateY: -60}, 
          {rotateX: 0},
          {rotateZ: 0} 
        ], 
      },
      titleImageFrame02: {
        width: 9.6,
        fontSize: 0.54,
        textAlign: 'center',
        fontWeight: '500',
        backgroundColor: '#634E42',
        color: '#FFF',
        paddingTop: .22,
        paddingBottom: .22,
        textAlignVertical: 'center',
        transform: [
          {translate: [12.7, 8.8, -10]}, 
          {rotateY: -60},
        ],
      },
      imageFrame03: {
        width: 31,
        height: 31,
        overflow: 'hidden',
        transform: [
          {translate: [44, 31, 35]}, 
          {scale: this.state.bounceValue},
          {rotateY: -120}, 
          {rotateX: 0},
          {rotateZ: 0} 
        ], 
      },
      titleImageFrame03: {
        width: 33,
        fontSize: 1.8,
        textAlign: 'center',
        fontWeight: '500',
        backgroundColor: '#634E42',
        color: '#FFF',
        paddingTop: .7,
        paddingBottom: .7,
        textAlignVertical: 'center',
        transform: [
          {translate: [43, 28, 35]}, 
          {rotateY: -120},
        ],
      },
      imageFrame04: {
        width: 130,
        height: 130,
        overflow: 'hidden',
        transform: [
          {translate: [-65, 115, 285]}, 
          {scale: this.state.bounceValue},
          {rotateY: -180}, 
          {rotateX: 0},
          {rotateZ: 0} 
        ], 
      },
      titleImageFrame04: {
        width: 135,
        fontSize: 7,
        textAlign: 'center',
        fontWeight: '500',
        backgroundColor: '#634E42',
        color: '#FFF',
        paddingTop: 3,
        paddingBottom: 3,
        textAlignVertical: 'center',
        transform: [
          {translate: [-67.5, 103, 285]}, 
          {rotateY: -180},
        ],
      },
      imageFrame05: {
        width: 230,
        height: 230,
        overflow: 'hidden',
        transform: [
          {translate: [-550, 310, 250]}, 
          {scale: this.state.bounceValue},
          {rotateY: -240}, 
          {rotateX: 0},
          {rotateZ: 0} 
        ], 
      },
      titleImageFrame05: {
        width: 240,
        fontSize: 12,
        textAlign: 'center',
        fontWeight: '500',
        backgroundColor: '#634E42',
        color: '#FFF',
        paddingTop: 7,
        paddingBottom: 7,
        textAlignVertical: 'center',
        transform: [
          {translate: [-556.5, 290, 250]}, 
          {rotateY: -240},
        ],
      },
      imageFrame06: {
        width: 225,
        height: 225,
        overflow: 'hidden',
        transform: [
          {translate: [-543, 565, -250]}, 
          {scale: this.state.bounceValue},
          {rotateY: -300}, 
          {rotateX: 0},
          {rotateZ: 0} 
        ], 
      },
      titleImageFrame06: {
        width: 235,
        fontSize: 12,
        textAlign: 'center',
        fontWeight: '500',
        backgroundColor: '#634E42',
        color: '#FFF',
        paddingTop: 7,
        paddingBottom: 7,
        textAlignVertical: 'center',
        transform: [
          {translate: [-547, 545, -250]}, 
          {rotateY: -300},
        ],
      },
    });
  }

  bounceAnimation() {
    this.state.bounceValue.setValue(1.1);
    Animated.spring(
      this.state.bounceValue,
      {
        toValue: 0.9,
        friction: 1,
      }
    ).start();
  }

  previousImage() {
    if (this.state.currentItem > 1) {
      this.setState((prevState) => ({ currentItem: prevState.currentItem - 1 }))
      this.bounceAnimation()
      console.log(this.state.currentItem-1)
      console.log(this.state.items.length)
      this.enableButtonNext()
      if ((this.state.currentItem - 1) == 1) {
        this.disableButtonPrevious()
      }
    }
  }

  nextImage() {
    if (this.state.currentItem < this.state.items.length) {
      this.setState((prevState) => ({ currentItem: prevState.currentItem + 1 }))
      this.bounceAnimation()
      this.enableButtonPrevious()
      if (this.state.items.length == (this.state.currentItem + 1)) {
        this.disableButtonNext()
      }
    }
  }

  getContent() {
    var url = Linking.getInitialURL()
    .then((url) => {
      if (url) {
        console.log('Initial url is: ' + url);
        var vrSpaceId = url.split('vr/?space=')[1];
        console.log('VR Space Id: ' + vrSpaceId);
        let config = {
          headers: {
            'Accept': 'application/json'
          }
        }
        axios.get(this.state.baseUrl + 'api/spaces/' + vrSpaceId, config)
          .then(res => {
            if (res.data.space.visibility === 1) {
              const space = res.data.space;
              this.setState({ space });
            } else {
              const space = '404';
              this.setState({ space });
            }
            const pano = res.data.panorama;
            const sounds = res.data.audio;
            const videopano = res.data.videopano;
            const items = res.data.slides;
            const slide01 = res.data.slides[0];
            const slide02 = res.data.slides[1];
            const slide03 = res.data.slides[2];
            const slide04 = res.data.slides[3];
            const slide05 = res.data.slides[4];
            const slide06 = res.data.slides[5];
            this.setState({ pano });
            this.setState({ sounds });
            this.setState({ videopano });
            this.setState({ items });
            this.setState({ slide01 });
            this.setState({ slide02 });
            this.setState({ slide03 });
            this.setState({ slide04 });
            this.setState({ slide05 });
            this.setState({ slide06 });

            if (this.state.currentItem = 1) {
              this.disableButtonPrevious()
            }
            if (items.length != this.state.currentItem) {
              this.enableButtonNext()
            } else {
              this.disableButtonNext()
            }
          })
        }
        this.go();
    })
    .catch(err => {
      console.error('An error occurred', err)
    })
  }

  disableButtonPrevious() {
    this.setState((prevState) => ({ disableButtonPrevious: prevState.disableButtonPrevious = true },
      { colorButton: prevState.colorButton = '#FFF' }
    ))
    this.setState({colorButton: '#FFF'})
    console.log(this.state.colorButton)
 }

  enableButtonPrevious() {
    this.setState((prevState) => ({ disableButtonPrevious: prevState.disableButtonPrevious = false },
      { colorButton: prevState.colorButton = '#FFF' }
    ))
    this.setState({colorButton: '#FFF'})
    console.log(this.state.colorButton)
 }

  disableButtonNext() {
    this.setState((prevState) => (
      { disableButtonNext: prevState.disableButtonNext = true },
      { colorButton: prevState.colorButton = '#FFF' }
    ))
    this.setState({colorButton: '#FFF'})
    console.log(this.state.colorButton)
 }

  enableButtonNext() {
    this.setState((prevState) => ({ disableButtonNext: prevState.disableButtonNext = false },
      { colorButton: prevState.colorButton = '#FFF' }
    ))
    this.setState({colorButton: '#FFF'})
    console.log(this.state.colorButton)
 }

  componentDidMount() {
    this.getContent()
    this.bounceAnimation()
  }

  render() {
        // SPACE TYPE 1
        this.state.space.type == 1 
      ?         
        this.state.display = <View>{this.state.pano.map(item => <Pano key={1} source={{uri: this.state.baseUrl + this.state.pano[0].value}} />)}{this.state.sounds.map(item => (this.state.sounds.length != 0) ? <Sound key={1} volume={1} loop={true} source={{uri: this.state.baseUrl + this.state.sounds[0].value}} /> : '')}</View>
      : 
        // SPACE TYPE 2
        this.state.space.type == 2 
      ? 
      this.state.display = <View>{this.state.videopano.map(item => <VideoPano key={1} loop={true} source={{uri: this.state.baseUrl + this.state.videopano[0].value}} />)}</View>
      : 
        // SPACE TYPE 3
        this.state.space.type == 3
      ?
        this.state.display = <View>
          {
            this.state.sounds.map(item => (this.state.sounds.length != 0) ? <Sound volume={5} key={1} loop={true} source={{uri: this.state.baseUrl + this.state.sounds[0].value}} /> : '')
          }
        <View style={this.styles.menu}>
            <VrButton disabled={this.state.disableButtonPrevious} style={this.styles.button} onEnter={() => this.previousImage()} onEnterSound={{ mp3: asset('click.mp3')}} > 
                <Text style={this.styles.text}>
                  Vorige
                </Text> 
            </VrButton>
            <VrButton disabled={this.state.disableButtonNext} style={this.styles.button} onEnter={() => this.nextImage()} onEnterSound={{ mp3: asset('click.mp3') }}> 
                <Text style={this.styles.text}>
                  Volgende
                </Text> 
            </VrButton>
        </View>
        {
          this.state.items
          .map(
            item => (item)
              ? 
              <View key={this.state.currentItem-1}>
                <Animated.Image style={this.styles.image} source={{uri: this.state.baseUrl + this.state.items[this.state.currentItem-1].value}}/>
                <Text style={this.styles.description}>{this.state.items[this.state.currentItem-1].title}</Text>
              </View>
              :
              <View>
              </View>
            )
        }
        <Pano source={asset('sliderpano.png')} />
      </View>
      :
        // SPACE TYPE 4
        this.state.space.type == 4
      ?
      this.state.display = <View>
        <View>
          {
            this.state.items.length === 2
              ?
            <View>
              {
                this.state.sounds.map(item => (this.state.sounds.length != 0) ? <Sound volume={20} key={1} loop={true} source={{uri: this.state.baseUrl + this.state.sounds[0].value}} /> : '')
              }
              <Animated.Image style={this.styles.imageFrame01} source={{uri: this.state.baseUrl + this.state.slide01.value}}/> 
              <Text style={this.styles.titleImageFrame01}>{this.state.slide01.title}</Text>
              <Animated.Image style={this.styles.imageFrame02} source={{uri: this.state.baseUrl + this.state.slide02.value}}/> 
              <Text style={this.styles.titleImageFrame02}>{this.state.slide02.title}</Text>
              <Pano source={asset('room02.png')}/>
            </View>
              :
            <View></View>
          }   
        </View>
        <View>
          {
            this.state.items.length === 3 
              ? 
            <View>
              {
                this.state.sounds.map(item => (this.state.sounds.length != 0) ? <Sound volume={60} key={1} loop={true} source={{uri: this.state.baseUrl + this.state.sounds[0].value}} /> : '')
              }
              <Animated.Image style={this.styles.imageFrame01} source={{uri: this.state.baseUrl + this.state.slide01.value}}/> 
              <Text style={this.styles.titleImageFrame01}>{this.state.slide01.title}</Text>
              <Animated.Image style={this.styles.imageFrame02} source={{uri: this.state.baseUrl + this.state.slide02.value}}/> 
              <Text style={this.styles.titleImageFrame02}>{this.state.slide02.title}</Text>
              <Animated.Image style={this.styles.imageFrame03} source={{uri: this.state.baseUrl + this.state.slide03.value}}/> 
              <Text style={this.styles.titleImageFrame03}>{this.state.slide03.title}</Text>
              <Pano source={asset('room03.png')}/>
            </View>
              : 
            <View></View>
          }
        </View>
        <View>
          {
            this.state.items.length === 4
              ? 
            <View>
              {
                this.state.sounds.map(item => (this.state.sounds.length != 0) ? <Sound volume={100} key={1} loop={true} source={{uri: this.state.baseUrl + this.state.sounds[0].value}} /> : '')
              }
              <Animated.Image style={this.styles.imageFrame01} source={{uri: this.state.baseUrl + this.state.slide01.value}}/> 
              <Text style={this.styles.titleImageFrame01}>{this.state.slide01.title}</Text>
              <Animated.Image style={this.styles.imageFrame02} source={{uri: this.state.baseUrl + this.state.slide02.value}}/> 
              <Text style={this.styles.titleImageFrame02}>{this.state.slide02.title}</Text>
              <Animated.Image style={this.styles.imageFrame03} source={{uri: this.state.baseUrl + this.state.slide03.value}}/> 
              <Text style={this.styles.titleImageFrame03}>{this.state.slide03.title}</Text>
              <Animated.Image style={this.styles.imageFrame04} source={{uri: this.state.baseUrl + this.state.slide04.value}}/> 
              <Text style={this.styles.titleImageFrame04}>{this.state.slide04.title}</Text>
              <Pano source={asset('room04.png')}/>
            </View>
              : 
            <View></View>
          }
        </View>
        <View>
          {
            this.state.items.length === 5
              ? 
            <View>
              {
                this.state.sounds.map(item => (this.state.sounds.length != 0) ? <Sound volume={140} key={1} loop={true} source={{uri: this.state.baseUrl + this.state.sounds[0].value}} /> : '')
              }
              <Animated.Image style={this.styles.imageFrame01} source={{uri: this.state.baseUrl + this.state.slide01.value}}/> 
              <Text style={this.styles.titleImageFrame01}>{this.state.slide01.title}</Text>
              <Animated.Image style={this.styles.imageFrame02} source={{uri: this.state.baseUrl + this.state.slide02.value}}/> 
              <Text style={this.styles.titleImageFrame02}>{this.state.slide02.title}</Text>
              <Animated.Image style={this.styles.imageFrame03} source={{uri: this.state.baseUrl + this.state.slide03.value}}/> 
              <Text style={this.styles.titleImageFrame03}>{this.state.slide03.title}</Text>
              <Animated.Image style={this.styles.imageFrame04} source={{uri: this.state.baseUrl + this.state.slide04.value}}/> 
              <Text style={this.styles.titleImageFrame04}>{this.state.slide04.title}</Text>
              <Animated.Image style={this.styles.imageFrame05} source={{uri: this.state.baseUrl + this.state.slide05.value}}/> 
              <Text style={this.styles.titleImageFrame05}>{this.state.slide05.title}</Text>
              <Pano source={asset('room05.png')}/>
            </View>
              : 
            <View></View>
          }
        </View>
        <View>
          {
            this.state.items.length === 6
              ? 
            <View>
              {
                this.state.sounds.map(item => (this.state.sounds.length != 0) ? <Sound volume={180} key={1} loop={true} source={{uri: this.state.baseUrl + this.state.sounds[0].value}} /> : '')
              }
              <Animated.Image style={this.styles.imageFrame01} source={{uri: this.state.baseUrl + this.state.slide01.value}}/> 
              <Text style={this.styles.titleImageFrame01}>{this.state.slide01.title}</Text>
              <Animated.Image style={this.styles.imageFrame02} source={{uri: this.state.baseUrl + this.state.slide02.value}}/> 
              <Text style={this.styles.titleImageFrame02}>{this.state.slide02.title}</Text>
              <Animated.Image style={this.styles.imageFrame03} source={{uri: this.state.baseUrl + this.state.slide03.value}}/> 
              <Text style={this.styles.titleImageFrame03}>{this.state.slide03.title}</Text>
              <Animated.Image style={this.styles.imageFrame04} source={{uri: this.state.baseUrl + this.state.slide04.value}}/> 
              <Text style={this.styles.titleImageFrame04}>{this.state.slide04.title}</Text>
              <Animated.Image style={this.styles.imageFrame05} source={{uri: this.state.baseUrl + this.state.slide05.value}}/> 
              <Text style={this.styles.titleImageFrame05}>{this.state.slide05.title}</Text>
              <Animated.Image style={this.styles.imageFrame06} source={{uri: this.state.baseUrl + this.state.slide06.value}}/> 
              <Text style={this.styles.titleImageFrame06}>{this.state.slide06.title}</Text>
              <Pano source={asset('room06.png')}/>
            </View>
              : 
            <View></View>
          }
        </View>
      </View>
      : 
        // SPACE TYPE 5
        this.state.space.type == 5
      ?
        this.state.display = <View>
          <View>
            {
              this.state.items.length === 2
                ?
              <View>
                {
                  this.state.sounds.map(item => (this.state.sounds.length != 0) ? <Sound volume={20} key={1} loop={true} source={{uri: this.state.baseUrl + this.state.sounds[0].value}} /> : '')
                }
                <Animated.Image style={this.styles.image01} source={{uri: this.state.baseUrl + this.state.slide01.value}}/> 
                <Text style={this.styles.titleSlide01}>{this.state.slide01.title}</Text>
                <Animated.Image style={this.styles.image02} source={{uri: this.state.baseUrl + this.state.slide02.value}}/> 
                <Text style={this.styles.titleSlide02}>{this.state.slide02.title}</Text>
                <Pano source={asset('timeline02.png')}/>
              </View>
                :
              <View></View>
            }   
          </View>
          <View>
            {
              this.state.items.length === 3 
                ? 
              <View>
                {
                  this.state.sounds.map(item => (this.state.sounds.length != 0) ? <Sound volume={60} key={1} loop={true} source={{uri: this.state.baseUrl + this.state.sounds[0].value}} /> : '')
                }
                <Animated.Image style={this.styles.image01} source={{uri: this.state.baseUrl + this.state.slide01.value}}/> 
                <Text style={this.styles.titleSlide01}>{this.state.slide01.title}</Text>
                <Animated.Image style={this.styles.image02} source={{uri: this.state.baseUrl + this.state.slide02.value}}/> 
                <Text style={this.styles.titleSlide02}>{this.state.slide02.title}</Text>
                <Animated.Image style={this.styles.image03} source={{uri: this.state.baseUrl + this.state.slide03.value}}/> 
                <Text style={this.styles.titleSlide03}>{this.state.slide03.title}</Text>
                <Pano source={asset('timeline03.png')}/>
              </View>
                : 
              <View></View>
            }
          </View>
          <View>
            {
              this.state.items.length === 4
                ? 
              <View>
                {
                  this.state.sounds.map(item => (this.state.sounds.length != 0) ? <Sound volume={100} key={1} loop={true} source={{uri: this.state.baseUrl + this.state.sounds[0].value}} /> : '')
                }
                <Animated.Image style={this.styles.image01} source={{uri: this.state.baseUrl + this.state.slide01.value}}/> 
                <Text style={this.styles.titleSlide01}>{this.state.slide01.title}</Text>
                <Animated.Image style={this.styles.image02} source={{uri: this.state.baseUrl + this.state.slide02.value}}/> 
                <Text style={this.styles.titleSlide02}>{this.state.slide02.title}</Text>
                <Animated.Image style={this.styles.image03} source={{uri: this.state.baseUrl + this.state.slide03.value}}/> 
                <Text style={this.styles.titleSlide03}>{this.state.slide03.title}</Text>
                <Animated.Image style={this.styles.image04} source={{uri: this.state.baseUrl + this.state.slide04.value}}/> 
                <Text style={this.styles.titleSlide04}>{this.state.slide04.title}</Text>
                <Pano source={asset('timeline04.png')}/>
              </View>
                : 
              <View></View>
            }
          </View>
          <View>
            {
              this.state.items.length === 5
                ? 
              <View>
                {
                  this.state.sounds.map(item => (this.state.sounds.length != 0) ? <Sound volume={140} key={1} loop={true} source={{uri: this.state.baseUrl + this.state.sounds[0].value}} /> : '')
                }
                <Animated.Image style={this.styles.image01} source={{uri: this.state.baseUrl + this.state.slide01.value}}/> 
                <Text style={this.styles.titleSlide01}>{this.state.slide01.title}</Text>
                <Animated.Image style={this.styles.image02} source={{uri: this.state.baseUrl + this.state.slide02.value}}/> 
                <Text style={this.styles.titleSlide02}>{this.state.slide02.title}</Text>
                <Animated.Image style={this.styles.image03} source={{uri: this.state.baseUrl + this.state.slide03.value}}/> 
                <Text style={this.styles.titleSlide03}>{this.state.slide03.title}</Text>
                <Animated.Image style={this.styles.image04} source={{uri: this.state.baseUrl + this.state.slide04.value}}/> 
                <Text style={this.styles.titleSlide04}>{this.state.slide04.title}</Text>
                <Animated.Image style={this.styles.image05} source={{uri: this.state.baseUrl + this.state.slide05.value}}/> 
                <Text style={this.styles.titleSlide05}>{this.state.slide05.title}</Text>
                <Pano source={asset('timeline05.png')}/>
              </View>
                : 
              <View></View>
            }
          </View>
          <View>
            {
              this.state.items.length === 6
                ? 
              <View>
                {
                  this.state.sounds.map(item => (this.state.sounds.length != 0) ? <Sound volume={180} key={1} loop={true} source={{uri: this.state.baseUrl + this.state.sounds[0].value}} /> : '')
                }
                <Animated.Image style={this.styles.image01} source={{uri: this.state.baseUrl + this.state.slide01.value}}/> 
                <Text style={this.styles.titleSlide01}>{this.state.slide01.title}</Text>
                <Animated.Image style={this.styles.image02} source={{uri: this.state.baseUrl + this.state.slide02.value}}/> 
                <Text style={this.styles.titleSlide02}>{this.state.slide02.title}</Text>
                <Animated.Image style={this.styles.image03} source={{uri: this.state.baseUrl + this.state.slide03.value}}/> 
                <Text style={this.styles.titleSlide03}>{this.state.slide03.title}</Text>
                <Animated.Image style={this.styles.image04} source={{uri: this.state.baseUrl + this.state.slide04.value}}/> 
                <Text style={this.styles.titleSlide04}>{this.state.slide04.title}</Text>
                <Animated.Image style={this.styles.image05} source={{uri: this.state.baseUrl + this.state.slide05.value}}/> 
                <Text style={this.styles.titleSlide05}>{this.state.slide05.title}</Text>
                <Animated.Image style={this.styles.image06} source={{uri: this.state.baseUrl + this.state.slide06.value}}/> 
                <Text style={this.styles.titleSlide06}>{this.state.slide06.title}</Text>
                <Pano source={asset('timeline06.png')}/>
              </View>
                : 
              <View></View>
            }
          </View>
        </View>
      : 
        // SPACE TYPE 5
        this.state.space == '404'
      ?
        this.state.display = <View>
          <Pano source={asset('404.png')}/>
        </View>
      : 
        this.state.display = <View>
        </View>
    return (
      <View>
        {this.state.display}
      </View>
    );
  }

};

AppRegistry.registerComponent('react_vr', () => react_vr);
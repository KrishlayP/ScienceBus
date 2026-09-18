import {
  AppBar,
  Avatar,
  Box,
  Button,
  Card,
  CardContent,
  Container,
  CssBaseline,
  IconButton,
  Stack,
  ThemeProvider,
  Toolbar,
  Typography,
  createTheme,
} from '@mui/material'
import ArrowForwardRoundedIcon from '@mui/icons-material/ArrowForwardRounded'
import MenuRoundedIcon from '@mui/icons-material/MenuRounded'
import { motion } from 'framer-motion'
import { ParallaxImage } from './components/react-bits/ParallaxImage'

const theme = createTheme({
  palette: {
    mode: 'dark',
    primary: { main: '#65e4ff' },
    secondary: { main: '#f7c948' },
    background: { default: '#05070a', paper: '#0b1018' },
    text: { primary: '#f8fbff', secondary: '#a9b7c9' },
  },
  shape: { borderRadius: 8 },
  typography: {
    fontFamily: 'Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif',
    h1: { fontWeight: 900, letterSpacing: 0 },
    h2: { fontWeight: 900, letterSpacing: 0 },
    h3: { fontWeight: 850, letterSpacing: 0 },
    button: { fontWeight: 850, textTransform: 'none' },
  },
  components: {
    MuiButton: {
      styleOverrides: {
        root: { borderRadius: 999, boxShadow: 'none' },
      },
    },
    MuiCard: {
      styleOverrides: {
        root: {
          borderRadius: 8,
          border: '1px solid rgba(255,255,255,.12)',
          backgroundImage: 'none',
        },
      },
    },
  },
})

const navItems = ['Home', 'News', 'Tour Profile', 'Team', 'Gallery', 'Contact Us']

const impact = [
  ['2018', 'Initiated'],
  ['100+', 'Experiments'],
  ['1000+', 'Students Reached'],
  ['75"', 'LCD Display'],
]

const programCards = [
  ['3D Printer', 'Advanced 3D printing technology for hands-on learning of modern manufacturing concepts.'],
  ['75 Inch LCD Display', 'Large high-definition display for engaging video demonstrations and animations.'],
  ['Microscope', 'Professional microscope for exploring the microscopic world in Physics, Chemistry, and Biology.'],
  ['Science Experiments', '100+ experiments for VI-XII standard students covering major scientific principles.'],
]

const tourImages = [
  '/sciencebus/gallery-1.jpeg',
  '/sciencebus/gallery-2.jpeg',
  '/sciencebus/gallery-3.jpeg',
  '/sciencebus/lab-bus.jpg',
]

function App() {
  return (
    <ThemeProvider theme={theme}>
      <CssBaseline />
      <Box className="min-h-screen bg-[#05070a] text-white">
        <Button
          href="#contact"
          variant="contained"
          className="fixed bottom-5 right-5 z-[60] hidden rounded-full bg-white px-5 py-3 text-black shadow-2xl shadow-black/30 md:inline-flex"
          endIcon={<ArrowForwardRoundedIcon />}
        >
          Plan a visit
        </Button>

        <AppBar position="fixed" elevation={0} color="transparent" className="z-50">
          <Toolbar className="mx-auto mt-4 w-[min(1180px,calc(100%-24px))] rounded-full border border-white/10 bg-black/35 px-4 backdrop-blur-xl">
            <Stack direction="row" spacing={1.5} className="min-w-0 flex-1" sx={{ alignItems: 'center' }}>
              <Avatar src="/sciencebus/logo.png" alt="Science Bus" sx={{ width: 38, height: 38, bgcolor: '#fff' }} />
              <Box>
                <Typography className="font-black tracking-wide">The Science Bus</Typography>
                <Typography variant="caption" className="hidden text-white/55 sm:block">
                  A Mobile Science Lab
                </Typography>
              </Box>
            </Stack>
            <Stack direction="row" spacing={1} className="hidden md:flex">
              {navItems.map((item) => (
                <Button key={item} href={`#${item.toLowerCase().replaceAll(' ', '-')}`} color="inherit" size="small" className="text-white/78">
                  {item}
                </Button>
              ))}
            </Stack>
            <Button href="#contact" variant="outlined" className="ml-3 hidden border-white/30 text-white sm:inline-flex">
              Login
            </Button>
            <IconButton className="ml-2 md:hidden" aria-label="Open menu">
              <MenuRoundedIcon />
            </IconButton>
          </Toolbar>
        </AppBar>

        <main>
          <section id="mission" className="relative min-h-screen overflow-hidden">
            <div className="absolute inset-0">
              <img src="/sciencebus/hero-bus.jpg" alt="Science Bus" className="h-full w-full object-cover opacity-70" />
              <div className="absolute inset-0 bg-[radial-gradient(circle_at_72%_18%,rgba(101,228,255,.24),transparent_28%),linear-gradient(90deg,#05070a_0%,rgba(5,7,10,.92)_35%,rgba(5,7,10,.34)_100%)]" />
            </div>

            <Container maxWidth="lg" className="relative z-10 flex min-h-screen items-end pb-14 pt-32">
              <Stack spacing={4} className="w-full">
                <Typography className="max-w-xl text-lg font-semibold text-cyan-100/85">
                  An IITK, CSTUP & UP Govt Initiative
                </Typography>
                <Typography
                  variant="h1"
                  sx={{
                    fontSize: { xs: 54, sm: 84, lg: 116 },
                    lineHeight: 0.9,
                    maxWidth: 930,
                  }}
                >
                  Bringing Science
                  <br />
                  {' '}
                  to Every Child&apos;s Doorstep
                </Typography>
                <Stack direction={{ xs: 'column', sm: 'row' }} spacing={1.5}>
                  <Button size="large" variant="contained" endIcon={<ArrowForwardRoundedIcon />} href="#about">
                    About The Science Bus
                  </Button>
                  <Button size="large" variant="text" className="text-white" href="#gallery">
                    Browse Gallery
                  </Button>
                </Stack>
              </Stack>
            </Container>
          </section>

          <section className="relative overflow-hidden py-24">
            <Container maxWidth="lg">
              <div className="grid min-h-[620px] grid-cols-2 gap-5 md:grid-cols-4">
                <ParallaxImage src={tourImages[0]} className="h-72 self-start opacity-90" depth={90} />
                <ParallaxImage src={tourImages[1]} className="mt-24 h-80 opacity-90" depth={140} delay={0.06} />
                <ParallaxImage src={tourImages[2]} className="h-96 self-end opacity-90" depth={110} delay={0.12} />
                <ParallaxImage src={tourImages[3]} className="mt-12 h-72 opacity-90" depth={160} delay={0.18} />
              </div>
            </Container>
          </section>

          <section id="about" className="py-24">
            <Container maxWidth="lg">
              <div className="grid gap-10 lg:grid-cols-[.9fr_1.1fr]">
                <div className="lg:sticky lg:top-28 lg:self-start">
                  <Typography variant="h2" sx={{ fontSize: { xs: 42, md: 72 }, lineHeight: 0.95 }}>
                    About The Science Bus
                  </Typography>
                </div>
                <Stack spacing={3}>
                  <Typography className="text-xl leading-8 text-white/70">
                    The Science Bus was a first-of-its-kind initiative at the time of its conception. It is developed
                    on a mobile bus platform and serves as a mobile laboratory.
                  </Typography>
                  <Typography className="text-lg leading-8 text-white/62">
                    With the objective of popularizing science among schoolchildren in remote areas, IIT Kanpur
                    initiated the Science Bus Project in collaboration with the Council of Science & Technology,
                    Uttar Pradesh (CST-UP). Students actively participate in conducting experiments and display a high
                    level of curiosity and enthusiasm during the sessions.
                  </Typography>
                  <Typography variant="h3" sx={{ fontSize: { xs: 30, md: 42 }, pt: 2 }}>
                    Facilities
                  </Typography>
                  <div className="grid gap-3 sm:grid-cols-2">
                    {programCards.map(([title, text], index) => (
                      <motion.div
                        key={title}
                        initial={{ opacity: 0, y: 24 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true, margin: '-80px' }}
                        transition={{ delay: index * 0.08, duration: 0.55 }}
                      >
                      <Card className="h-full bg-white/[.045]">
                        <CardContent>
                          <Typography className="font-black text-white">{title}</Typography>
                          <Typography className="mt-3 text-sm leading-6 text-white/62">{text}</Typography>
                        </CardContent>
                      </Card>
                      </motion.div>
                    ))}
                  </div>
                </Stack>
              </div>
            </Container>
          </section>

          <section id="gallery" className="bg-white py-24 text-[#06111f]">
            <Container maxWidth="lg">
              <Stack spacing={5}>
                <Stack direction={{ xs: 'column', md: 'row' }} sx={{ justifyContent: 'space-between', gap: 3 }}>
                  <Typography variant="h2" sx={{ fontSize: { xs: 42, md: 68 }, lineHeight: 0.96, maxWidth: 700 }}>
                    Select a location to view college-wise Science Bus visit photos.
                  </Typography>
                  <Typography className="max-w-sm text-lg leading-8 text-slate-600">
                    Browse Gallery becomes an editorial photo journey: locations, albums, and school visit photos
                    presented with cinematic scroll rhythm.
                  </Typography>
                </Stack>

                <div className="grid gap-4 md:grid-cols-3">
                  {[
                    ['Locations', 'Select a location to view college-wise Science Bus visit photos.'],
                    ['Albums', 'Select a college to view all photos from this visit.'],
                    ['Photos', 'Click any photo to preview it.'],
                  ].map(([title, text], index) => (
                    <motion.div
                      key={title}
                      initial={{ opacity: 0, y: 30 }}
                      whileInView={{ opacity: 1, y: 0 }}
                      viewport={{ once: true, margin: '-80px' }}
                      transition={{ delay: index * 0.1, duration: 0.6 }}
                    >
                    <Card className="h-full border-slate-200 bg-slate-50 shadow-none">
                      <CardContent className="p-6">
                        <Typography variant="h4" className="font-black text-[#06111f]">
                          {title}
                        </Typography>
                        <Typography className="mt-4 leading-7 text-slate-600">{text}</Typography>
                      </CardContent>
                    </Card>
                    </motion.div>
                  ))}
                </div>
              </Stack>
            </Container>
          </section>

          <section id="impact" className="py-24">
            <Container maxWidth="lg">
              <Typography variant="h2" sx={{ fontSize: { xs: 44, md: 78 }, lineHeight: 0.95, maxWidth: 760 }}>
                Our Impact
              </Typography>
              <div className="mt-10 grid gap-px overflow-hidden rounded-lg border border-white/10 bg-white/10 md:grid-cols-4">
                {impact.map(([value, label], index) => (
                  <motion.div
                    key={label}
                    className="bg-[#080d14] p-7"
                    initial={{ opacity: 0, y: 22 }}
                    whileInView={{ opacity: 1, y: 0 }}
                    viewport={{ once: true, margin: '-80px' }}
                    transition={{ delay: index * 0.07, duration: 0.55 }}
                  >
                    <Typography variant="h3" className="font-black text-cyan-100">
                      {value}
                    </Typography>
                    <Typography className="mt-2 text-white/60">{label}</Typography>
                  </motion.div>
                ))}
              </div>
            </Container>
          </section>

          <section id="contact" className="relative overflow-hidden py-24">
            <img src="/sciencebus/lab-bus.jpg" alt="" className="absolute inset-0 h-full w-full object-cover opacity-24" />
            <div className="absolute inset-0 bg-[#05070a]/75" />
            <Container maxWidth="lg" className="relative">
              <Typography variant="h2" sx={{ fontSize: { xs: 44, md: 88 }, lineHeight: 0.94, maxWidth: 900 }}>
                Want The Science Bus at Your School?
              </Typography>
              <Typography className="mt-5 max-w-2xl text-lg leading-8 text-white/70">
                Contact us today to schedule a visit and bring hands-on science education.
              </Typography>
              <Stack direction={{ xs: 'column', sm: 'row' }} spacing={1.5} className="mt-8">
                <Button size="large" variant="contained" endIcon={<ArrowForwardRoundedIcon />}>
                  Contact Us
                </Button>
                <Button size="large" variant="outlined" className="border-white/25 text-white">
                  See Gallery
                </Button>
              </Stack>
            </Container>
          </section>
        </main>
      </Box>
    </ThemeProvider>
  )
}

export default App

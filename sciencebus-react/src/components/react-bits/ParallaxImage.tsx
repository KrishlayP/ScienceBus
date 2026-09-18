import { motion, useScroll, useTransform } from 'framer-motion'
import { useRef } from 'react'

type ParallaxImageProps = {
  src: string
  alt?: string
  className?: string
  depth?: number
  delay?: number
}

export function ParallaxImage({ src, alt = '', className = '', depth = 70, delay = 0 }: ParallaxImageProps) {
  const ref = useRef<HTMLDivElement>(null)
  const { scrollYProgress } = useScroll({
    target: ref,
    offset: ['start end', 'end start'],
  })
  const y = useTransform(scrollYProgress, [0, 1], [depth, -depth])
  const scale = useTransform(scrollYProgress, [0, 0.5, 1], [1.08, 1, 1.08])

  return (
    <motion.div
      ref={ref}
      className={`overflow-hidden rounded-lg ${className}`}
      initial={{ opacity: 0, y: 34 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true, margin: '-80px' }}
      transition={{ delay, duration: 0.65, ease: [0.22, 1, 0.36, 1] }}
    >
      <motion.img src={src} alt={alt} className="h-full w-full object-cover" style={{ y, scale }} />
    </motion.div>
  )
}

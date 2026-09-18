type AuroraProps = {
  className?: string
}

export function Aurora({ className = '' }: AuroraProps) {
  return (
    <div className={`aurora-field ${className}`} aria-hidden="true">
      <span />
      <span />
      <span />
    </div>
  )
}
